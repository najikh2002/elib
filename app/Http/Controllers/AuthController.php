<?php

namespace App\Http\Controllers;

use App\Models\Accapp;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Mjenisbuku;
use App\Models\Mpenerbit;
use App\Models\Mpengarang;
use App\Models\Msubyek;
use App\Models\Msumberperolehan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function home()
    {
        $bukus = Buku::all();
        $jenisbukus = Mjenisbuku::all();

        return view("welcome", compact(["bukus", "jenisbukus"]));
    }

    public function login()
    {
        return view("login");
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
        'user' => 'required',
        'password' => 'required',
        ]);

        $user = Accapp::where('useracc', $validatedData['user'])->first();

        if (!$user || $validatedData['password'] != $user->userpass) {
            return back()->withErrors([
                'message' => 'Nama atau password salah.'
            ]);
        }

        $anggota = Anggota::where('useracc', $validatedData['user'])->first();

        $request->session()->put('anggota', $anggota);
        $request->session()->put('kodeanggota', $anggota->kodeanggota);
        $request->session()->put('user', $user);
        $request->session()->save();

        return redirect()->intended('/logged');
    }


    public function logged()
    {
        return redirect(route('user'));
    }

    public function user()
    {
        $anggota = session()->get('anggota');

        $bukus = Buku::all();
        $semuapinjam = Peminjaman::all();
        $pinjams = $semuapinjam->where('kodeanggota', $anggota->kodeanggota)->where('tglkembali', NULL);
        $pinjamcount = $pinjams->count();

        return view('user.index', compact('bukus', 'pinjams', 'pinjamcount'));
    }

    public function seller()
    {
        $jenisbukus = Mjenisbuku::all();
        $penerbits = Mpenerbit::all();
        $pengarangs = Mpengarang::all();
        $subyeks = Msubyek::all();
        $sumberperolehans = Msumberperolehan::all();

        return view('seller.index', compact(['jenisbukus', 'penerbits', 'pengarangs', 'subyeks', 'sumberperolehans']));
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();

        return redirect('home')->with('sucess', 'Berhasil Logout!');
    }

}
