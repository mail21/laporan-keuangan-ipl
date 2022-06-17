<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;


class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'user') {
                return redirect()->to('/home');
            } else {
                return redirect()->to('/dashboard');
            }
        }
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $user = User::where('kode', $request->input('kode'))->first();

        if ($user) {
            if (Hash::check($request->input('password'), $user->password)) {
                Auth::login($user);
            }
            if (Auth::check()) {
                $user = Auth::user();

                if ($user->role == 'user') {
                    return redirect()->to('/home');
                } else {
                    return redirect()->to('/dashboard');
                }
            } else {
                Session::flash('error', 'kode atau password user salah');
                return redirect()->route('login');
            }
        }  else {
            Session::flash('error', 'Masukan kode atau Password');
            return redirect()->route('login');
        }
    }

    public function showFormRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];

        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function profile()
    {
        return view('pages.profile');
    }
}
