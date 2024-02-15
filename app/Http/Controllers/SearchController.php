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
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    // SEARCH INPUT SERVICE
    public function caribuku(Request $request)
    {
        $search_input = $request->input('search');

        $data = Buku::select('buku.*', DB::raw('STRING_AGG(mpengarang.namapengarang, \', \') as namapengarang'))
            ->where('judulbuku', 'ilike', '%' . $search_input . '%')
            ->orWhereHas('jenisbuku', function ($query) use ($search_input) {
                $query->where('namajenisbuku', 'ilike', '%' . $search_input . '%');
            })
            ->orWhereHas('bukupengarang.pengarang', function ($query) use ($search_input) {
                $query->where('namapengarang', 'ilike', '%' . $search_input . '%');
            })
            ->join('bukupengarang', 'buku.kodebuku', '=', 'bukupengarang.kodebuku')
            ->join('mpengarang', 'bukupengarang.kodepengarang', '=', 'mpengarang.kodepengarang')
            ->groupBy('buku.kodebuku', 'buku.judulbuku', 'buku.tahun', 'buku.isbn')
            ->get();

        return view('cari', compact(['data', 'search_input']));
    }

    public function carijenisbuku($jenisbuku)
    {
        $data = Buku::select('buku.*', DB::raw('STRING_AGG(mpengarang.namapengarang, \', \') as namapengarang'))
            ->where('judulbuku', 'ilike', '%' . $jenisbuku . '%')
            ->orWhereHas('jenisbuku', function ($query) use ($jenisbuku) {
                $query->where('namajenisbuku', 'ilike', '%' . $jenisbuku . '%');
            })
            ->join('bukupengarang', 'buku.kodebuku', '=', 'bukupengarang.kodebuku')
            ->join('mpengarang', 'bukupengarang.kodepengarang', '=', 'mpengarang.kodepengarang')
            ->groupBy('buku.kodebuku', 'buku.judulbuku', 'buku.tahun', 'buku.isbn')
            ->get();

        return view('jenis', compact(['data', 'jenisbuku']));
    }
}
