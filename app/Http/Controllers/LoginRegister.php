<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class LoginRegister extends Controller
{
    public function actionlogin(Request $request){
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('admin');
            } else {
                return redirect('home');
            }
        }else{
            if (User::where('email', $request->input('email'))->exists()) {
                session()->flash('modal_message', 'Password salah. silahkan coba lagi!');
            } else {
                session()->flash('modal_message', 'Email salah atau tidak terdaftar!');
            }            
            return redirect('login');
        }
    }

    public function redirectgoogle(){
        if (!Auth::check()) {
            return Socialite::driver('google')->redirect();
        } else {
            return redirect()->intended('home');
        }
    }

    public function handlergoogle(){
        $user = Socialite::driver('google')->user();
        $finduser = User::where('email', $user->getEmail())->first();        
        if($finduser){
            Auth::login($finduser);
            return redirect()->intended('home');
        } else {
            list($username, $domain) = explode('@', $user->getEmail());
            $newuser = User::create([
                'email' => $user->getEmail(),
                'name' => $username,
                'password' => Hash::make('akusukakoding'),
                'role' => 'user',
                'tipe' => 'google',
                'username_change' => '0'
            ]);
    
            event(new Registered($newuser));
    
            Auth::login($newuser);
            session()->flash('modal_message', 'Berhasil terdaftar!');
            return redirect('/email/verify');
        }
    }
    
    public function actionregister(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            session()->flash('modal_message', 'Email sudah digunakan');
            return redirect('register');
        } else {
            list($username, $domain) = explode('@', $request->email);
            
            $user = User::create([
                'email' => $request->email,
                'name' => $username, // Simpan nama pengguna di sini
                'password' => Hash::make($request->password),
                'role' => 'user',
                'tipe' => 'normal',
                'username_change' => '0'
            ]);
        
            event(new Registered($user));
        
            Auth::login($user);
            session()->flash('modal_message', 'Berhasil terdaftar!');
            return redirect('/email/verify');
        }
    }    

    public function actionlogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    public function emailverify()
    {
        return view('auth.verify-email');
    }

    public function verifverify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('home');
    }

    public function forgotpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->where('tipe', 'normal')->first();
        if (!$user) {
            session()->flash('modal_message', 'Email salah atau tidak terdaftar!');
        }

        $status = Password::sendResetLink($request->only('email'));
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('modal_message', 'Link reset sudah dikirim ke email!');
        } else {
            return back()->with('modal_message', 'Email salah atau tidak terdaftar!');
        }

        
    }


    public function restpwtkn(string $token)
    {
        return view('resetpassword', ['token' => $token]);
    }

    public function restpw(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
