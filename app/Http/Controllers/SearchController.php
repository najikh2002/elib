<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Mbahasa;
use App\Models\Mjenisbuku;
use App\Models\Mpenerbit;
use App\Models\Mpengarang;
use App\Models\Msubyek;
use App\Models\Msumberperolehan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // SEARCH INPUT SERVICE
    public function caribuku(Request $request)
    {
        $search_input = $request->input('search');

        $judulbuku = Buku::where('judulbuku', 'ilike', '%' . $search_input . '%')->get();
        $jenisbuku = Mjenisbuku::where('namajenisbuku', 'ilike', '%' . $search_input . '%')->get();
        $pengarang = Mpengarang::where('namapengarang', 'ilike', '%' . $search_input . '%')->get();

        $data = [
            'judulbuku' => $judulbuku,
            'jenisbuku' => $jenisbuku,
            'pengarangbuku' => $pengarang,
        ];

        return view('cari', compact(['data']));
    }

    // CARI SUMBER PEROLEHAN
    public function carisumberperolehan($nama)
    {
        $sperolehan = Msumberperolehan::where('namasumberperolehan', 'ilike', '%' . $nama . '%')->get();

        if ($sperolehan->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'msg' => 'Data tidak ditemukan'
            ], 404); // Status 404 untuk menandakan data tidak ditemukan
        }

        $res = [
            'status' => true,
            'data' => $sperolehan,
            'msg' => ''
        ];

        return response()->json($res);
    }

    // CARI PENGARANG
    public function caripengarang($nama)
    {
        $pengarang = Mpengarang::where('namapengarang', 'ilike', '%' . $nama . '%')->get();

        if ($pengarang->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'msg' => 'Data tidak ditemukan'
            ], 404); // Status 404 untuk menandakan data tidak ditemukan
        }

        $res = [
            'status' => true,
            'data' => $pengarang,
            'msg' => ''
        ];

        return response()->json($res);
    }

    // CARI PENERBIT
    public function caripenerbit($nama)
    {
        $penerbit = Mpenerbit::where('namapenerbit', 'ilike', '%' . $nama . '%')->get();

        if ($penerbit->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'msg' => 'Data tidak ditemukan'
            ], 404); // Status 404 untuk menandakan data tidak ditemukan
        }

        $res = [
            'status' => true,
            'data' => $penerbit,
            'msg' => ''
        ];

        return response()->json($res);
    }

    // CARI JENIS BUKU
    public function carijenisbuku($nama)
    {
        $jenisbuku = Mjenisbuku::where('namajenisbuku', 'ilike', '%' . $nama . '%')->get();

        if ($jenisbuku->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'msg' => 'Data tidak ditemukan'
            ], 404); // Status 404 untuk menandakan data tidak ditemukan
        }

        $res = [
            'status' => true,
            'data' => $jenisbuku,
            'msg' => ''
        ];

        return response()->json($res);
    }

    // CARI SUBYEK
    public function carisubyek($nama)
    {
        $subyek = Msubyek::where('namasubyek', 'ilike', '%' . $nama . '%')->get();

        if ($subyek->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'msg' => 'Data tidak ditemukan'
            ], 404); // Status 404 untuk menandakan data tidak ditemukan
        }

        $res = [
            'status' => true,
            'data' => $subyek,
            'msg' => ''
        ];

        return response()->json($res);
    }

    // CARI BAHASA
    public function caribahasa($nama)
    {
        $bahasa = Mbahasa::where('namabahasa', 'ilike', '%' . $nama . '%')->get();

        if ($bahasa->isEmpty()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'msg' => 'Data tidak ditemukan'
            ], 404); // Status 404 untuk menandakan data tidak ditemukan
        }

        $res = [
            'status' => true,
            'data' => $bahasa,
            'msg' => ''
        ];

        return response()->json($res);
    }
}
