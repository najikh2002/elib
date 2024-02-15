<?php

namespace App\Http\Controllers;

use App\Models\Accapp;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\BukuPengarang;
use App\Models\BukuProgramstudi;
use App\Models\Mbahasa;
use App\Models\Mjenisbuku;
use App\Models\Mpenerbit;
use App\Models\Mpengarang;
use App\Models\Mpriv;
use App\Models\Msubyek;
use App\Models\Msumberperolehan;
use App\Models\Peminjaman;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SellerController extends Controller
{
    public function index()
    {
        $totalpinjambulanan = DB::table('v_totalpinjambulanan')->get();

        return view("seller.index", compact(['totalpinjambulanan']));
    }

    // FILE PDF
    public function file_pdf()
    {
        return view('seller.page.filepdf');
    }

    public function filepdf(Request $request)
    {
        $pdfFile = $request->file('filepdf');
        $path = $pdfFile->store('pdfs', 'public');
        $pdf = Pdf::loadFile(storage_path("app/public/{$path}"));

        $manipulatedPath = "pdfs/manipulated_" . now()->format('YmdHis') . ".pdf";
        $pdf->save(storage_path("app/public/{$manipulatedPath}"));

        // Tampilkan tautan ke PDF yang dimanipulasi
        return asset("storage/{$manipulatedPath}");
    }

    // BUKU
    private function randomName($request)
    {
        $file = $request->file('filebuku');

        $nameFile = Str::random(10) . '.' . $file->getClientOriginalExtension();

        // Simpan file dengan nama acak
        $sameName = Buku::where('filebuku', $nameFile)->first();

        if($sameName) {
            $res = $this->randomName($request);
        }else{
            $res = $nameFile;
        }

        return $res;
    }

    public function buku()
    {
        $jenisbukus = Mjenisbuku::all();
        $penerbits = Mpenerbit::all();
        $pengarangs = Mpengarang::all();
        $subyeks = Msubyek::all();
        $sumberperolehans = Msumberperolehan::all();
        $bahasas = Mbahasa::all();
        $programstudis = ProgramStudi::all();
        $bukupengarangs = BukuPengarang::all();

        $bukus = Buku::all();

        return view('seller.page.buku', compact(['jenisbukus', 'penerbits', 'pengarangs', 'subyeks', 'sumberperolehans', 'bukus', 'bahasas', 'programstudis', 'bukupengarangs']));
    }

    public function buatbuku(Request $request)
    {
        $file = $request->file('filebuku');

        $nameFile = $this->randomName($request);
        $pdfPath = $file->storeAs('secret', $nameFile);

        $randomName = Str::random(10);
        $outputPath = "{$randomName}.png";

        $cImgPath = storage_path("app/public/{$randomName}.png");
        $cFilePath = storage_path("app/" . $pdfPath);

        $command = "gs -dFirstPage=1 -dLastPage=1 -sDEVICE=png16m -o $cImgPath $cFilePath";
        shell_exec($command);

        $active = $request->input('active') ? true : false;

        $existingCodes = Buku::pluck('kodebuku')->toArray();
        $kodebuku = 1;
        while (in_array($kodebuku, $existingCodes)) {
            $kodebuku++;
        }

        $pengarangs = $request->input('kodepengarang');
        $programstudis = $request->input('programstudi');

        $data = [
            'kodebuku' => $kodebuku,
            'kodesumberperolehan' => $request->input('kodesumberperolehan'),
            'kodepenerbit' => $request->input('kodepenerbit'),
            'kodejenisbuku' => $request->input('kodejenisbuku'),
            'kodesubyek' => $request->input('kodesubyek'),
            'judulbuku' => $request->input('judulbuku'),
            'tahun' => $request->input('tahun'),
            'jumlahhalaman' => $request->input('jumlahhalaman'),
            'jumlahexemplar' => $request->input('jumlahexemplar'),
            'kodebahasa' => $request->input('kodebahasa'),
            'active' => $active,
            'sinopsis' => $request->input('sinopsis'),
            'isbn' => $request->input('isbn'),
            'edisi' => $request->input('edisi'),
            'filebuku' => $pdfPath,
            'sampulbuku' => $outputPath,
        ];

        Buku::create($data);

        foreach($pengarangs as $pengarang){

            $bukupengarang = [
                'kodebuku' => $kodebuku,
                'kodepengarang' => $pengarang,
            ];

            BukuPengarang::create($bukupengarang);
        }

        foreach($programstudis as $kodeps){

            $bukuprogramstudi = [
                'kodebuku' => $kodebuku,
                'kodeps' => $kodeps,
            ];

            BukuProgramstudi::create($bukuprogramstudi);
        }



        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dibuat!',
            'data' => $data,
        ]);
    }

    public function editbuku($id)
    {
        // HEAD
        $buku = Buku::where('kodebuku', $id)->first();

        // Array Data
        $bukupengarang = BukuPengarang::where('kodebuku', $id)->get();
        $bukups = BukuProgramstudi::where('kodebuku', $id)->get();

        $kodepengarangArray = $bukupengarang->pluck('kodepengarang')->toArray();
        $kodepsArray = $bukups->pluck('kodeps')->toArray();

        $kodepengarangMultiple = Mpengarang::whereIn('kodepengarang', $kodepengarangArray)->pluck('kodepengarang')->toArray();
        $namapengarangMultiple = Mpengarang::whereIn('kodepengarang', $kodepengarangArray)->pluck('namapengarang')->toArray();

        $kodepsMultiple = ProgramStudi::whereIn('kodeps', $kodepsArray)->pluck('kodeps')->toArray();
        $namapsMultiple = ProgramStudi::whereIn('kodeps', $kodepsArray)->pluck('namaps')->toArray();
        // databuku
        $penerbit = Mpenerbit::where('kodepenerbit', $buku->kodepenerbit)->first();
        $sumberperolehan = Msumberperolehan::where('kodesumberperolehan', $buku->kodesumberperolehan)->first();
        $jenisbuku = Mjenisbuku::where('kodejenisbuku', $buku->kodejenisbuku)->first();
        $subyek = Msubyek::where('kodesubyek', $buku->kodesubyek)->first();
        $bahasa = Mbahasa::where('kodebahasa', $buku->kodebahasa)->first();
        $pengarang = [
            'kodepengarang' => $kodepengarangMultiple,
            'namapengarang' => $namapengarangMultiple,
        ];
        $programstudi = [
            'kodeps' => $kodepsMultiple,
            'namaps' => $namapsMultiple,
        ];

        $databuku = [
            'pengarang' => $pengarang,
            'penerbit' => $penerbit,
            'jenisbuku' => $jenisbuku,
            'subyek' => $subyek,
            'bahasa' => $bahasa,
            'programstudi' => $programstudi,
            'sumberperolehan' => $sumberperolehan,
        ];


        $res = [
            'status' => true,
            'data' => [
                'buku' => $buku,
                'databuku' => $databuku,
            ],
            'msg' => ''
        ];

        return json_encode($res);
    }



    public function updatebuku(Request $request)
    {
        try {
            $buku = Buku::where('kodebuku', $request->kodebuku)->first();

            if ($buku) {
                if($request->hasFile('filebuku')) {
                    if($buku->filebuku) {
                        Storage::delete($buku->filebuku);

                        $sampulPath = public_path("storage/{$buku->sampulbuku}");
                        if (File::exists($sampulPath)) {
                            File::delete($sampulPath);
                        }
                    }
                    $file = $request->file('filebuku');
                    $nameFile = $this->randomName($request);
                    $pdfPath = $file->storeAs('secret', $nameFile);
                    $buku->filebuku = $pdfPath;

                    $randomName = Str::random(10);
                    $outputPath = "{$randomName}.png";
                    $cImgPath = storage_path("app/public/{$randomName}.png");
                    $cFilePath = storage_path("app/" . $pdfPath);
                    $command = "gs -dFirstPage=1 -dLastPage=1 -sDEVICE=png16m -o $cImgPath $cFilePath";
                    shell_exec($command);

                    $buku->sampulbuku = $outputPath;
                }

                $buku->judulbuku = $request->input('judulbuku_edit');
                $buku->tahun = $request->input('tahun_edit');
                $buku->edisi = $request->input('edisi_edit');
                $buku->isbn = $request->input('isbn_edit');
                $buku->jumlahhalaman = $request->input('jumlahhalaman_edit');
                $buku->jumlahexemplar = $request->input('jumlahexemplar_edit');
                $buku->kodesumberperolehan = $request->input('sumberperolehan_edit');
                $buku->kodepenerbit = $request->input('penerbit_edit');
                $buku->kodejenisbuku = $request->input('jenisbuku_edit');
                $buku->kodesubyek = $request->input('subyek_edit');
                $buku->kodebahasa = $request->input('bahasa_edit');
                $buku->sinopsis = $request->input('sinopsis_edit');
                $buku->active = $request->input('active_edit') ? true : false;

                $buku->save();

                BukuPengarang::where('kodebuku', $request->kodebuku)->delete();
                BukuProgramstudi::where('kodebuku', $request->kodebuku)->delete();

                $pengarangs = $request->input('pengarang_edit');
                $programstudis = $request->input('programstudi_edit');

                if ($pengarangs) {
                    foreach ($pengarangs as $kodepengarang) {
                        $existingEntry = BukuPengarang::where('kodebuku', $request->kodebuku)
                            ->where('kodepengarang', $kodepengarang)
                            ->first();

                        if (!$existingEntry) {
                            $bukupengarang = [
                                'kodebuku' => $request->kodebuku,
                                'kodepengarang' => $kodepengarang,
                            ];
                            BukuPengarang::create($bukupengarang);
                        }
                    }
                }

                if ($programstudis) {
                    foreach ($programstudis as $kodeps) {
                        $existingEntry = BukuProgramstudi::where('kodebuku', $request->kodebuku)
                            ->where('kodeps', $kodeps)
                            ->first();

                        if (!$existingEntry) {
                            $bukuprogramstudi = [
                                'kodebuku' => $request->kodebuku,
                                'kodeps' => $kodeps,
                            ];
                            BukuProgramstudi::create($bukuprogramstudi);
                        }
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Buku berhasil diperbarui.',
                    'data' => $buku,
                ]);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Buku tidak ditemukan.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }



    public function hapusbuku($kodebuku)
    {
        try {
            $buku = Buku::where('kodebuku', $kodebuku)->first();

            if ($buku) {
                $fileUrl = "http://localhost:8000/storage/" . $buku->sampulbuku;
                $filePath = public_path(str_replace('http://localhost:8000/', '', $fileUrl));
                File::delete($filePath);
                BukuPengarang::where('kodebuku', $kodebuku)->delete();
                BukuProgramstudi::where('kodebuku', $kodebuku)->delete();
                Peminjaman::where('kodebuku', $kodebuku)->delete();
                Storage::delete($buku->filebuku);

                $buku->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Buku berhasil dihapus.',
                ]);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Buku tidak ditemukan.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }


    // PENGARANG
    public function pengarang()
    {
        $pengarangs = Mpengarang::all();

        return view('seller.page.pengarang', compact(['pengarangs']));
    }

    public function buatpengarang(Request $request)
    {
        $request->validate([
            'namapengarang' => 'required',
        ]);

        $existingCodes = Mpengarang::pluck('kodepengarang')->toArray();
        $kodepengarang = 1;
        while (in_array($kodepengarang, $existingCodes)) {
            $kodepengarang++;
        }

        $data = [
            'kodepengarang' => $kodepengarang,
            'namapengarang' => $request->input('namapengarang'),
            'tempatlhr' => $request->input('tempatlhr'),
            'tanggallhr' => $request->date('tanggallhr'),
        ];

        Mpengarang::create($data);

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Data Berhasil Dibuat!',
        ]);
    }

    public function editpengarang($id)
    {
        $pengarang = Mpengarang::where('kodepengarang', $id)->first();

        $res = [
            'status' => true,
            'data' => $pengarang,
            'msg' => ''
        ];

        return json_encode($res);
    }

    public function updatepengarang(Request $request)
    {
        $request->validate([
            'namapengarang' => 'required',
        ]);

        $pengarang = Mpengarang::where('kodepengarang', $request->input('kodepengarang'))->first();

        if(!$pengarang) {
            return response()->json([
                'success' => false,
                'message' => 'Pengarang tidak ditemukan',
            ]);
        }

        $data = [
            'kodepengarang' => $pengarang->kodepengarang,
            'namapengarang' => $request->input('namapengarang'),
            'tempatlhr' => $request->input('tempatlhr'),
            'tanggallhr' => $request->date('tanggallhr'),
        ];

        $pengarang->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Pengarang BERHASIL diupdate',
            'data' => $data,
        ]);
    }

    public function listpengarang()
    {
        $data = Mpengarang::all();

        return response()->json([
           'success' => true,
           'message' => 'Data Berhasil Didapat!',
           'data' => $data,
        ]);
    }

    public function hapuspengarang($kodepengarang)
    {
        try {
            $pengarang = Mpengarang::where('kodepengarang', $kodepengarang)->first();

            if ($pengarang) {
                $pengarang->delete();

                return redirect()->route('pengarang')->with('success', 'Jenis Buku berhasil dihapus.');
            } else {
                return redirect()->route('pengarang')->with('error', 'Jenis Buku tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('pengarang')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // SUBYEK BUKU
    public function subyek()
    {
        $subyeks = Msubyek::all();

        return view('seller.page.subyek', compact(['subyeks']));
    }

    public function buatsubyek(Request $request)
    {
        $request->validate([
            'namasubyek' => 'required',
        ]);

        $existingCodes = Msubyek::pluck('kodesubyek')->toArray();
        $kodesubyek = 1;
        while (in_array($kodesubyek, $existingCodes)) {
            $kodesubyek++;
        }

        $data = [
            'kodesubyek' => $kodesubyek,
            'namasubyek' => $request->input('namasubyek'),
        ];

        Msubyek::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan!',
            'data' => $data,
        ]);
    }

    public function editsubyek($id)
    {
        $subyek = Msubyek::where('kodesubyek', $id)->first();

        $res = [
            'status' => true,
            'data' => $subyek,
            'msg' => ''
        ];

        return json_encode($res);
    }

    public function updatesubyek(Request $request)
    {
        $request->validate([
            'kodesubyek_edit' => 'required',
            'namasubyek_edit' => 'required',
        ]);

        $data = [
            'kodesubyek' => $request->input('kodesubyek_edit'),
            'namasubyek' => $request->input('namasubyek_edit'),
        ];


        $subyek = Msubyek::where('kodesubyek', $request->kodesubyek_edit);

        if(!$subyek) {
            return response()->json([
                'success' => false,
                'message' => 'Subyek tidak ditemukan',
            ]);
        }

        $subyek->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Subyek BERHASIL diupdate',
            'data' => $data,
        ]);
    }

    public function listsubyek()
    {
        $data = Msubyek::all();

        return response()->json([
           'success' => true,
           'message' => 'Data Berhasil Didapat!',
           'data' => $data,
        ]);
    }

    public function hapussubyek($kodesubyek)
    {
        try {
            $subyek = Msubyek::where('kodesubyek', $kodesubyek)->first();

            if ($subyek) {
                $subyek->delete();

                return redirect()->route('subyek')->with('success', 'Subyek Buku berhasil dihapus.');
            } else {
                return redirect()->route('subyek')->with('error', 'Subyek Buku tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('subyek')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // PENERBIT BUKU
    public function penerbit()
    {
        $penerbits = Mpenerbit::all();

        return view('seller.page.penerbit', compact(['penerbits']));
    }

    public function buatpenerbit(Request $request)
    {
        $request->validate([
            'namapenerbit' => 'required',
        ]);

        $existingCodes = Mpenerbit::pluck('kodepenerbit')->toArray();
        $kodepenerbit = 1;
        while (in_array($kodepenerbit, $existingCodes)) {
            $kodepenerbit++;
        }

        $data = [
            'kodepenerbit' => $kodepenerbit,
            'namapenerbit' => $request->input('namapenerbit'),
            'alamatpenerbit' => $request->input('alamatpenerbit'),
            'kota' => $request->input('kota'),
        ];

        Mpenerbit::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Didapat!',
            'data' => $data
        ]);
    }

    public function editpenerbit($id)
    {
        $penerbit = Mpenerbit::where('kodepenerbit', $id)->first();

        $res = [
            'status' => true,
            'data' => $penerbit,
            'msg' => ''
        ];

        return json_encode($res);
    }

    public function updatepenerbit(Request $request)
    {
        $request->validate([
            'kodepenerbit_edit' => 'required',
            'namapenerbit_edit' => 'required',
        ]);

        $data = [
            'kodepenerbit' => $request->input('kodepenerbit_edit'),
            'namapenerbit' => $request->input('namapenerbit_edit'),
            'alamatpenerbit' => $request->input('alamatpenerbit_edit'),
            'kota' => $request->input('kota_edit'),
        ];


        $penerbit = Mpenerbit::where('kodepenerbit', $request->kodepenerbit_edit);

        if(!$penerbit) {
            return response()->json([
                'success' => false,
                'message' => 'Bahasa tidak ditemukan',
            ]);
        }

        $penerbit->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Bahasa BERHASIL diupdate',
            'data' => $data,
        ]);
    }
    public function listpenerbit()
    {
        $data = Mpenerbit::all();

        return response()->json([
           'success' => true,
           'message' => 'Data Berhasil Didapat!',
           'data' => $data,
        ]);
    }

    public function hapuspenerbit($kodepenerbit)
    {
        try {
            $penerbit = Mpenerbit::where('kodepenerbit', $kodepenerbit)->first();

            if ($penerbit) {
                $penerbit->delete();

                return redirect()->route('penerbit')->with('success', 'Penerbit Buku berhasil dihapus.');
            } else {
                return redirect()->route('penerbit')->with('error', 'Penerbit Buku tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('penerbit')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // JENIS BUKU
    public function jenisbuku()
    {
        $jenisbukus = Mjenisbuku::all();

        return view('seller.page.jenisbuku', compact(['jenisbukus']));
    }

    public function buatjenisbuku(Request $request)
    {
        $request->validate([
            'namajenisbuku' => 'required',
        ]);

        $existingCodes = Mjenisbuku::pluck('kodejenisbuku')->toArray();
        $kodejenisbuku = 1;
        while (in_array($kodejenisbuku, $existingCodes)) {
            $kodejenisbuku++;
        }

        $data = [
            'kodejenisbuku' => $kodejenisbuku,
            'namajenisbuku' => $request->input('namajenisbuku'),
        ];

        Mjenisbuku::create($data);

        return response()->json([
           'success' => true,
           'message' => 'Data Berhasil Disimpan!',
           'data' => $data,
        ]);
    }

    public function listjenisbuku()
    {
        $data = Mjenisbuku::all();

        return response()->json([
           'success' => true,
           'message' => 'Data Berhasil Didapat!',
           'data' => $data,
        ]);
    }

    public function editjenisbuku($id)
    {
        $jenisbuku = Mjenisbuku::where('kodejenisbuku', $id)->first();

        $res = [
            'status' => true,
            'data' => $jenisbuku,
            'msg' => ''
        ];

        return json_encode($res);
    }

    public function updatejenisbuku(Request $request)
    {
        $request->validate([
            'kodejenisbuku_edit' => 'required',
            'namajenisbuku_edit' => 'required',
        ]);

        $data = [
            'kodejenisbuku' => $request->input('kodejenisbuku_edit'),
            'namajenisbuku' => $request->input('namajenisbuku_edit'),
        ];


        $jenisbuku = Mjenisbuku::where('kodejenisbuku', $request->kodejenisbuku_edit);

        if(!$jenisbuku) {
            return response()->json([
                'success' => false,
                'message' => 'Bahasa tidak ditemukan',
            ]);
        }

        $jenisbuku->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Bahasa BERHASIL diupdate',
            'data' => $data,
        ]);
    }

    public function hapusjenisbuku($kodejenisbuku)
    {
        try {
            $jenisBuku = Mjenisbuku::where('kodejenisbuku', $kodejenisbuku)->first();

            if ($jenisBuku) {
                $jenisBuku->delete();

                return redirect()->route('jenisbuku')->with('success', 'Jenis Buku berhasil dihapus.');
            } else {
                return redirect()->route('jenisbuku')->with('error', 'Jenis Buku tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('jenisbuku')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // BAHASA
    public function bahasa()
    {
        $bahasas = Mbahasa::all();

        return view('seller.page.bahasa', compact(['bahasas']));
    }

    public function buatbahasa(Request $request)
    {
        $request->validate([
            'namabahasa' => 'required',
        ]);

        $existingCodes = Mbahasa::pluck('kodebahasa')->toArray();
        $kodebahasa = 1;
        while (in_array($kodebahasa, $existingCodes)) {
            $kodebahasa++;
        }

        $data = [
            'kodebahasa' => $kodebahasa,
            'namabahasa' => $request->input('namabahasa')
        ];

        Mbahasa::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan!',
            'data' => $data,
        ]);
    }

    public function editbahasa($id)
    {
        $bahasa = Mbahasa::where('kodebahasa', $id)->first();

        $res = [
            'status' => true,
            'data' => $bahasa,
            'msg' => ''
        ];

        return json_encode($res);
    }

    public function updatebahasa(Request $request)
    {
        $request->validate([
            'kodebahasa_edit' => 'required',
            'namabahasa_edit' => 'required',
        ]);

        $data = [
            'kodebahasa' => $request->input('kodebahasa_edit'),
            'namabahasa' => $request->input('namabahasa_edit'),
        ];

        $bahasa = Mbahasa::where('kodebahasa', $request->kodebahasa_edit);

        if(!$bahasa) {
            return response()->json([
                'success' => false,
                'message' => 'Bahasa tidak ditemukan',
            ]);
        }

        $bahasa->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Bahasa BERHASIL diupdate',
            'data' => $data,
        ]);
    }

    public function listbahasa()
    {
        $data = Mbahasa::all();

        return response()->json([
           'success' => true,
           'message' => 'Data Berhasil Didapat!',
           'data' => $data,
        ]);
    }

    public function hapusbahasa($kodebahasa)
    {
        try {
            $bahasa = Mbahasa::where('kodebahasa', $kodebahasa)->first();

            if ($bahasa) {
                $bahasa->delete();

                return redirect()->route('bahasa')->with('success', 'Bahasa berhasil dihapus.');
            } else {
                return redirect()->route('bahasa')->with('error', 'Bahasa tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('bahasa')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // SUMBER PEROLEHAN
    public function sumberperolehan()
    {
        $sumberperolehans = Msumberperolehan::all();

        return view('seller.page.sumberperolehan', compact(['sumberperolehans']));
    }

    public function buatsumberperolehan(Request $request)
    {
        $request->validate([
            'namasumberperolehan' => 'required',
        ]);

        $existingCodes = Msumberperolehan::pluck('kodesumberperolehan')->toArray();
        $kodesumberperolehan = 1;
        while (in_array($kodesumberperolehan, $existingCodes)) {
            $kodesumberperolehan++;
        }

        $data = [
            'kodesumberperolehan' => $kodesumberperolehan,
            'namasumberperolehan' => $request->input('namasumberperolehan'),
        ];

        Msumberperolehan::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $data
        ]);
    }

    public function listsumberperolehan()
    {
        $data = Msumberperolehan::all();

        return response()->json([
           'success' => true,
           'message' => 'Data Berhasil Didapat!',
           'data' => $data,
        ]);
    }

    public function editsumberperolehan($id)
    {
        $sp = Msumberperolehan::where('kodesumberperolehan', $id)->first();

        $res = [
            'status' => true,
            'data' => $sp,
            'msg' => ''
        ];

        return json_encode($res);
    }

    public function updatesumberperolehan(Request $request)
    {
        $request->validate([
            'kodesumberperolehan_edit' => 'required',
            'namasumberperolehan_edit' => 'required',
        ]);

        $data = [
            'kodesumberperolehan' => $request->input('kodesumberperolehan_edit'),
            'namasumberperolehan' => $request->input('namasumberperolehan_edit'),
        ];


        $sp = Msumberperolehan::where('kodesumberperolehan', $request->kodesumberperolehan_edit);

        if(!$sp) {
            return response()->json([
                'success' => false,
                'message' => 'Bahasa tidak ditemukan',
            ]);
        }

        $sp->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Bahasa BERHASIL diupdate',
            'data' => $data,
        ]);
    }

    public function hapussumberperolehan($kodesumberperolehan)
    {
        try {
            $sp = Msumberperolehan::where('kodesumberperolehan', $kodesumberperolehan)->first();

            if ($sp) {
                $sp->delete();

                return redirect()->route('sumber-perolehan')->with('success', 'Bahasa berhasil dihapus.');
            } else {
                return redirect()->route('sumber-perolehan')->with('error', 'Bahasa tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('sumber-perolehan')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ANGGOTA
    public function anggota()
    {
        $anggotas = Anggota::all();
        $programstudis = ProgramStudi::all();

        return view('seller.page.anggota', compact(["anggotas", "programstudis"]));
    }

    public function buatanggota(Request $request)
    {
        $existingCodes = Anggota::pluck('kodeanggota')->toArray();
        $kodeanggota = 1;
        while (in_array($kodeanggota, $existingCodes)) {
            $kodeanggota++;
        }

        $foto = $request->file('foto');
        $foto_path = $foto->storeAs('public/foto', $foto->hashName());

        $anggota_data = [
            'kodeanggota' => $kodeanggota,
            'nama' => $request->input('nama'),
            'institusiasal' => $request->input('institusiasal'),
            'kodeangkatan' => $request->input('kodeangkatan'),
            'nova' => $request->input('nova'),
            'email' => $request->input('email'),
            'nohp' => $request->input('nohp'),
            'tempatlahir' => $request->input('tempatlahir'),
            'tgllahir' => $request->input('tgllahir'),
            'foto' => $foto_path,
            'tglaktif' => $request->input('tglaktif'),
            'tglkadaluwarsa' => $request->input('tglkadaluwarsa'),
            'useracc' => $request->input('useracc'),
            'userpass' => $request->input('userpass'),
            'kodeps' => $request->input('kodeps'),
            'status' => $request->input('status'),
        ];

        $user_data = [
            'useracc' => $request->input('useracc'),
            'userpass' => $request->input('userpass'),
            'kodepriv' => $request->input('kodepriv'),
        ];

        Accapp::create($user_data);
        Anggota::create($anggota_data);

        $data = [
            'anggota_data' => $anggota_data,
            'user_data' => $user_data
        ];

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan!',
            'data' => $data,
        ]);
    }

    public function editanggota($id)
    {
        $ps = ProgramStudi::all();
        $anggota = Anggota::where('kodeanggota', $id)->first();
        $useracc = $anggota->useracc;
        $accapp = Accapp::where('useracc', $useracc)->first();
        $anggota->userpass = $accapp->userpass;
        $anggota->kodepriv = $accapp->kodepriv;
        $anggota->dataps = $ps;

        $res = [
            'status' => true,
            'data' => $anggota,
            'msg' => ''
        ];

        return json_encode($res);
    }

    public function updateanggota(Request $request)
    {
        $anggota_data = [
            'kodeanggota' => $request->input('kodeanggota_edit'),
            'nama' => $request->input('nama_edit'),
            'institusiasal' => $request->input('institusiasal_edit'),
            'kodeangkatan' => $request->input('kodeangkatan_edit'),
            'nova' => $request->input('nova_edit'),
            'email' => $request->input('email_edit'),
            'nohp' => $request->input('nohp_edit'),
            'tempatlahir' => $request->input('tempatlahir_edit'),
            'tgllahir' => $request->input('tgllahir_edit'),
            'tglaktif' => $request->input('tglaktif_edit'),
            'tglkadaluwarsa' => $request->input('tglkadaluwarsa_edit'),
            'kodeps' => $request->input('kodeps_edit'),
            'useracc' => $request->input('useracc_edit'),
            'status' => $request->input('status'),
        ];

        $user_data = [
            'useracc' => $request->input('useracc_edit'),
            'userpass' => $request->input('userpass_edit'),
            'kodepriv' => $request->input('kodepriv_edit'),
        ];

        $data = [
            'anggota' => $anggota_data,
            'user' => $user_data
        ];

        $anggota = Anggota::where('kodeanggota', $request->kodeanggota_edit);
        $accapp = Accapp::where('useracc', $request->useracc_edit);

        $anggota->update($anggota_data);
        $accapp->update($user_data);

        return response()->json([
            'success' => true,
            'message' => 'Anggota Berhasil diperbarui',
            'data' => $data
        ]);
    }

    public function hapusanggota($kodeanggota)
    {
        try {
            $anggota = Anggota::where('kodeanggota', $kodeanggota)->first();

            if ($anggota) {
                if ($anggota->foto) {
                    // Hapus file foto hanya jika nilai $anggota->foto tidak null
                    Storage::delete($anggota->foto);
                }
                $useracc = $anggota->useracc;
                Peminjaman::where('kodeanggota', $kodeanggota)->delete();
                $anggota->delete();
                Accapp::where('useracc', $useracc)->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Anggota berhasil dihapus.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Anggota tidak ditemukan.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    // LAPORAN
    public function laporan($laporan)
    {
        if($laporan == 'totalbaca') {
            //
        }

        if($laporan == 'totalbacaperuser') {
            $data = DB::table('v_totalbacaperuser')->get();
            return view('seller.page.totalbacaperuser', compact(['data']));
        }

        if($laporan == 'totalbacaperkonten') {
            $data = DB::table('v_totalpinjamperkonten')->get();
            return view('seller.page.totalbacaperkonten', compact(['data']));
        }

        if($laporan == 'totalbuku') {
            $data = DB::table('v_totalbuku')->get();
            return view('seller.page.totalbuku', compact(['data']));
        }

        if($laporan == 'totalanggota') {
            //
        }

        if($laporan == 'totalpengunjung') {
            //
        }

        if($laporan == 'peminjaman') {
            $data = DB::table('v_peminjaman')->get();
            return view('seller.page.peminjaman', compact(['data']));
        }

        if($laporan == 'peminjam') {
            //
        }

        if($laporan == 'pengunjung') {
            //
        }
    }
}
