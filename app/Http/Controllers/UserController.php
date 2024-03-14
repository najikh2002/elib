<?php

namespace App\Http\Controllers;

use App\Models\Accapp;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function refresh(Request $request)
    {
        $todayEntry = Pengunjung::firstOrNew([
            'tanggal' => now()->toDateString(),
        ]);

        if (!$todayEntry->exists) {
            $todayEntry->jumlah = 1;
            $todayEntry->save();
        } else {
            $todayEntry->incrementJumlah();
        }

        return response()->noContent();
    }
    public function profile(Request $request)
    {
        $kodeanggota = $request->session()->get("kodeanggota");
        $anggota = Anggota::where('kodeanggota', $kodeanggota)->first();
        $peminjaman = DB::table('peminjaman')->where('kodeanggota', $kodeanggota)
                          ->join('buku', 'peminjaman.kodebuku', '=', 'buku.kodebuku')
                          ->join('mpenerbit', 'buku.kodepenerbit', '=', 'mpenerbit.kodepenerbit')
                          ->join('msubyek', 'buku.kodesubyek', '=', 'msubyek.kodesubyek')
                          ->join('mjenisbuku', 'buku.kodejenisbuku', '=', 'mjenisbuku.kodejenisbuku')
                          ->select('buku.*', 'peminjaman.*','mpenerbit.namapenerbit as namapenerbit', 'msubyek.namasubyek as namasubyek', 'mjenisbuku.namajenisbuku as namajenisbuku')
                          ->get();

        return view('user.profile', compact(['anggota', 'peminjaman']));
    }

    public function detailbuku($id)
    {
        $salt = 'hzhz';

        // $key = hash('sha256', $salt, true);
        // $data = base64_decode($id);
        // $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
        // $kodebuku = openssl_decrypt(substr($data, openssl_cipher_iv_length('aes-256-cbc')), 'aes-256-cbc', $key, 0, $iv);

        // $buku = Buku::where('kodebuku', $kodebuku)->first();
        $buku = Buku::where('kodebuku', $id)->first();
        $anggota = session()->get('anggota');
        $pinjam = Peminjaman::where('kodeanggota', $anggota->kodeanggota)->where('kodebuku', $buku->kodebuku)->where('tglkembali', NULL)->first();


        if (!$buku) {
            return redirect('dashboard');
        }

        return view('components.item-view', compact(['buku', 'pinjam', 'anggota']));
    }

    public function pinjambuku($id)
    {
        $user = session()->get('anggota');
        $buku = Buku::where('kodebuku', $id)->first();
        $ispinjam = Peminjaman::where('kodeanggota', $user->kodeanggota)->where('tglkembali', NULL)->count();

        if ($ispinjam > 2) {
            return redirect('home')->with('Error', 'Peminjaman anda lebih dari tiga buku!');
        }

        $pinjam = [
            'kodeanggota' => $user->kodeanggota,
            'kodebuku' => $buku->kodebuku,
            'tglpinjam' => date('Y-m-d'),
            'tglkembali' => null, // Initially set tglkembali as NULL
        ];

        //$pinjam['tglkembali'] = date('Y-m-d', strtotime($pinjam['tglpinjam'] . '+5 days'));

        Peminjaman::create($pinjam);
        session()->put('pinjam', $pinjam);

        return redirect("home")->with('success', 'Buku berhasil dipinjam');
    }

    public function batalpinjambuku($id)
    {
        $anggota = session()->get('anggota');
        $buku = Buku::where('kodebuku', $id)->first();

        {
            try {
            $pinjam = Peminjaman::where('kodeanggota', $anggota->kodeanggota)->where('kodebuku', $buku->kodebuku)->where('tglkembali', NULL)->first();

                if ($pinjam) {
                    $pinjam->tglkembali = date('Y-m-d');
                    $pinjam->update();

                    return redirect('/home')->with('success', 'Buku berhasil dikembalikan');
                 } else {
                    return redirect('/home')->with('success', 'Buku gagal dikembalikan');
                }
            } catch (\Exception $e) {
                return redirect('/detail/'.$id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }

    }

    public function updatephotoprofile(Request $request)
    {
        try {
            $kodeanggota = $request->session()->get("kodeanggota");
            $anggota = Anggota::where('kodeanggota', $kodeanggota)->first();

            if (!$anggota) {
                throw new \Exception('Anggota tidak ditemukan.');
            }

            $foto = $request->file('input_img_profile');
            if (!$foto) {
                throw new \Exception('File tidak tersedia.');
            }

            if ($anggota->foto) {
                Storage::delete($anggota->foto);
            }

            $foto_path = $foto->storeAs('public/foto', $foto->hashName());

            $anggota->update(['foto' => $foto_path]);

            return response()->json(['success' => true, 'message' => 'Foto berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }


    public function updatepasswordprofile(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $kodeanggota = $request->session()->get("kodeanggota");
        $anggota = DB::table('anggota')->where('kodeanggota', $kodeanggota)
                            ->join('accapp', 'accapp.useracc', '=', 'anggota.useracc')
                            ->select('anggota.*', 'accapp.userpass as userpass')
                            ->first();

        $accapp = Accapp::where('useracc', $anggota->useracc)->first();

        if ($request->old_password != $anggota->userpass) {
            return response()->json(['success' => false, 'message' => 'Password lama tidak sesuai.']);
        }

        if($request->new_password != $request->confirm_password) {
            return response()->json(['success' => false, 'message' => 'Konfirmasi Password tidak sesuai.']);
        }

        if($request->new_password == $request->old_password) {
            return response()->json(['success' => false, 'message' => 'Password tidak ada perubahan.']);
        }

        $accapp->update([
            'userpass' => $request->new_password,
        ]);

        return response()->json(['success' => true, 'message' => 'Password berhasil diperbarui.']);
    }

}
