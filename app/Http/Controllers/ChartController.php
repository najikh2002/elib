<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function baca()
    {
        $totalpinjam = DB::table('v_totalpinjambulanan')
                           ->where('tahun', date('Y'))
                           ->orderBy('bulan')
                           ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil didapat',
            'data' =>  $totalpinjam
        ]);
    }
    public function totalpinjamanggota()
    {
        $totalpinjamanggota = DB::table('v_tpanggota')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil didapat',
            'data' =>  $totalpinjamanggota
        ]);
    }

    public function totalbacaperbuku()
    {
        $totalbacaperbuku = DB::table('v_totalbacakonten')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil didapat',
            'data' =>  $totalbacaperbuku
        ]);
    }

    public function totalbuku()
    {
        //
    }

    public function totalanggota()
    {
        $anggotaday = DB::table('v_totalanggotaday')->get();
        $anggotamonth = DB::table('v_totalanggotamonth')->get();
        $anggotayear = DB::table('v_totalanggotayear')->get();
        $anggotaps = DB::table('v_totalanggotaps')->get();

        $data = [
            'day' => $anggotaday,
            'month' => $anggotamonth,
            'year' => $anggotayear,
            'prodi' => $anggotaps
        ];

        return response()->json([
            'success' => true,
            'message' => 'Success get data',
            'data' => $data,
        ]);
    }
}
