<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class InterfacePHP extends Controller
{
    public function index(){
        return view('home');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function pesan(){
        return view('form_pemesanan');
    }


    public function profileform()
    {
        return view('profileform');
    }

    public function profile()
    {   
        return view('profil');
    }

    public function pesanan()
    {
        return view('pesanan');
    }

    public function riwayat_detail($id)
    {
        $det_pesanan = DB::table('pesanans')
                        ->join('users', 'pesanans.id_user', '=', 'users.id')
                        ->select('pesanans.*', 'users.username as nama_user')
                        ->where('pesanans.id', $id)
                        ->get();
        return view('pesanan_saya_detail', ['det_pesanan' => $det_pesanan]);
    }
}
