<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Pesanans;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Midtrans\Transaction;

class Crud extends Controller
{
    public function username(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->username_change = '1';
        $user->save();
        return redirect('profile');
    }

    public function storealamat(Request $request)
    {
        $user = User::find(Auth::id());
        $user->username = $request->input('username');
        $user->telp = $request->input('tlp');
        $user->alamat = $request->input('alamat');
        $user->provinsi = $request->input('provinsi');
        $user->id_kota = $request->input('kota_id');
        $user->kota = $request->input('kota');
        $user->kodepos = $request->input('kodepos');
        $user->save();
        return redirect('alamat');
    }

    public function pushrole(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        $user->role = $request->role;
        $user->save();

        return redirect('admin');

    }

    public function alamat()
    {
        return view('alamat', ['provinsi' => Province::all()]);
    }
    
    public function showKota($idProv)
    {
        $kota = City::where('province_id', $idProv)->orderBy('name')->distinct()->get();
        return response()->json($kota);
    }

    public function showKodepos($idKota)
    {
        $kodepos = City::where('id', $idKota)->distinct()->get();
        return response()->json($kodepos);
    }

    public function pesansekarang(Request $request)
    {
        $user = User::find(Auth::id());
        $jumlahPesanan = Pesanans::where('id', $user->id)->count();
        $jumlahPesanan++;
        if ($request->hasFile('file')) {
            $extFile = $request->file->getClientOriginalExtension();
            $namaFile = 'pesanan'.$user->id.$jumlahPesanan.'.'.$extFile;
            $request->file->storeAs('public', $namaFile);
        }

        $no_pesanan = random_int(1000000000, 9999999999);

        $pesanans = new Pesanans();
        $pesanans->id_user = $user->id;
        $pesanans->id = $no_pesanan;
        $pesanans->ukuran = implode(',', [$request->panjang, $request->lebar, $request->jumlah]);
        $pesanans->jumlah_pesanan = $request->jumlah_pesanan;
        $pesanans->nama_gambar = $namaFile;
        $pesanans->deskripsi_tambahan = $request->deskripsi_tambahan;
        $pesanans->pengiriman = $request->pengiriman;
        $pesanans->pilih_kurir = $request->pilih_kurir;
        $pesanans->servis = $request->service;
        $pesanans->hrg_brg = $request->total_barang;
        $pesanans->hrg_ongkir = $request->total_ongkir;
        $pesanans->total = $request->total_harga;
        $pesanans->id_status = '5';
        $pesanans->save();
        
        return redirect()->route('pesanansaya');
    }

    public function pay(Request $request)
    {
        $orderId = $request->order_id;
        $order = Pesanans::find($orderId);
        $email = User::find($order->id_user);
        $payload = [
            'transaction_details' => [
                'order_id'     => $order->id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $email->email,
            ],
        ];

        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');

        $snapToken = \Midtrans\Snap::getSnapToken($payload);

        return response()->json([
            'snapToken' => $snapToken,
        ]);

    }

    public function updatePaymentStatus(Request $request){
        $orderId = $request->order_id;
        $order = Pesanans::find($orderId);
    
        if(!$order){
            return response()->json([
                'status' => false,
                'message' => 'Order not found'
            ], 404);
        }
    
        $order->id_status = 0;
        $order->tanggal_bayar = now();
        $order->save();
    
        return response()->json([
            'status' => true,
            'message' => 'Payment status updated successfully'
        ]);
    }

    public function userData()
    {
        $users = User::all();
        return view('admin', ['users' => $users]);
    }

    public function pesanan()
    {
        $pesanan = DB::table('pesanans')
                    ->join('users', 'pesanans.id_user', '=', 'users.id')
                    ->select('pesanans.*', 'users.username as nama_user')
                    ->get();
    
        return view('pesanan', ['pesanan' => $pesanan]);
    }
    
    public function detail_pesanan($id)
    {
        $det_pesanan = DB::table('pesanans')
                        ->join('users', 'pesanans.id_user', '=', 'users.id')
                        ->select('pesanans.*', 'users.username as nama_user')
                        ->where('pesanans.id', $id)
                        ->get();
        return view('pesanan_detail', ['det_pesanan' => $det_pesanan]);
    }
    

    public function pesanansaya()
    {
        $items = Pesanans::where('id_user', Auth::id())->get();
        return view('pesanan_saya', ['item' => $items]);
    }   

    public function checkOngkir(Request $request){
        try {
            $response = Http::withOptions(['verify' => false,])->withHeaders([
                'key' => env('RAJAONGKIR_API_KEY')
            ])->post('https://api.rajaongkir.com/starter/cost',[
                'origin'        => $request->origin,
                'destination'   => $request->destination,
                'weight'        => $request->weight,
                'courier'       => $request->courier
            ])
            ->json()['rajaongkir']['results'][0]['costs'];

            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'data'    => []
            ]);
        }
    }

    public function id_status($no_pesanan, $status, $resi){
        $pesanan = Pesanans::find($no_pesanan);
        $pesanan->id_status = $status;
        $pesanan->resi = $resi;
        $pesanan->save();
        return redirect()->route('pesanan');
    }
    
}
