<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index_profile_user(Request $request)
    {
        return view('pages.profile');
    }

    public function index_profile_admin(Request $request)
    {
        return view('pages.profileAdmin');
    }

    public function index(Request $request)
    {
        $users = User::paginate(5)->withQueryString();;
        return view('pages.users', compact('users'));
    }

    public function edit(Request $request)
    {
        try {
            $user = User::find($request->kode);

            $user->kode = $request->kode;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->nomor_hp = $request->nomor_hp;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->to('/users')->with('message', json_encode(['pesan' => 'Data Berhasil diedit']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/users')->with('error', 'Data gagal diedit');;
        }
    }

    public function hapus(Request $request)
    {
        try {
            $user = User::find($request->kode);

            $user->delete();

            return redirect()->to('/users')->with('message', json_encode(['pesan' => 'Data Berhasil dihapus']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/users')->with('error', 'Data gagal dihapus');;
        }
    }


    public function store(Request $request)
    {
        try {
            $user = new User();

            $user->kode = $request->kode;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->nomor_hp = $request->nomor_hp;
            $user->role = $request->role;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->to('/users')->with('message', json_encode(['pesan' => 'Data Berhasil Ditambah']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/users')->with('error', 'Data gagal ditambah');;
        }
    }

    public function ubahPassword(Request $request)
    {
        try {
            $user = Auth::user();

            if (Hash::check($request->password_lama, $user->password)) {
                $user = User::find($user->kode);

                $user->password = Hash::make($request->password_baru);
                $user->save();
                return redirect()->to('/profile')->with('message', 'Password Berhasil Terubah');
            }

            return redirect()->to('/profile')->with('error', 'Password Lama Tidak Sesuai');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/profile')->with('error', 'Password gagal Terubah');;
        }
    }

    public function ubahPasswordAdmin(Request $request)
    {
        try {
            $user = Auth::user();

            if (Hash::check($request->password_lama, $user->password)) {
                $user = User::find($user->kode);

                $user->password = Hash::make($request->password_baru);
                $user->save();
                return redirect()->to('/profile-admin')->with('message', 'Password Berhasil Terubah');
            }

            return redirect()->to('/profile-admin')->with('error', 'Password Lama Tidak Sesuai');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/profile-admin')->with('error', 'Password gagal Terubah');;
        }
    }
}
