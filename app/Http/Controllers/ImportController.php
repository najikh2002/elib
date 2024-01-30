<?php

namespace App\Http\Controllers;

use App\Models\Accapp;
use App\Models\Anggota;
use App\Models\Buku;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RKD\PHPExcelFormatter\PHPExcelFormatter;
use RKD\PHPExcelFormatter\Exception\PHPExcelFormatterException;

class ImportController extends Controller
{
    public function importanggota(Request $request)
    {
        $file = $request->file('dataanggota');
        $allowedMimeTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if (!in_array($file->getClientMimeType(), $allowedMimeTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'File yang diunggah bukan file Excel yang valid.'
            ]);
        }

        $formatter = new PHPExcelFormatter($file);

        $formatterColumns = [
            0 => 'nama',
            1 => 'institusiasal',
            2 => 'kodeangkatan',
            3 => 'nova',
            4 => 'email',
            5 => 'nohp',
            6 => 'tempatlhr',
            7 => 'tgllahir',
            8 => 'status',
            9 => 'foto',
            10 => 'tglaktif',
            11 => 'tglkadaluwarsa',
            12 => 'kodeps',
            13 => 'useracc',
            14 => 'userpass',
        ];

        $formatter->setFormatterColumns($formatterColumns);

        try {
            $outputArray = $formatter->output('array');

            foreach ($outputArray as $data) {

                $existingCodes = Anggota::pluck('kodeanggota')->toArray();
                $kodeanggota = 1;
                while (in_array($kodeanggota, $existingCodes)) {
                    $kodeanggota++;
                }

                $anggota = [
                    'kodeanggota' => $kodeanggota,
                    'nama' => $data['nama'],
                    'institusiasal' => $data['institusiasal'],
                    'kodeangkatan' => strval($data['kodeangkatan']),
                    'nova' => strval($data['nova']),
                    'email' => $data['email'],
                    'nohp' => strval($data['nohp']),
                    'tempatlahir' => $data['tempatlhr'],
                    'tgllahir' => Date::excelToDateTimeObject($data['tgllahir'])->format('Y-m-d'),
                    'status' => $data['status'],
                    'foto' => $data['foto'],
                    'tglaktif' => Date::excelToDateTimeObject($data['tglaktif'])->format('Y-m-d'),
                    'tglkadaluwarsa' => Date::excelToDateTimeObject($data['tglkadaluwarsa'])->format('Y-m-d'),
                    'useracc' => $data['useracc'],
                    'kodeps' => strval($data['kodeps']),
                ];

                $user = [
                    'useracc' => $data['useracc'],
                    'userpass' => $data['userpass'],
                    'kodepriv' => "3",
                ];

                Accapp::create($user);
                Anggota::create($anggota);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data imported successfully',
                'data' => $outputArray
            ]);
        } catch (PHPExcelFormatterException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error importing data: ' . $e->getMessage(),
            ]);
        }
    }

    public function importbuku(Request $request)
    {
        $file = $request->file('databuku');
        $allowedMimeTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if (!in_array($file->getClientMimeType(), $allowedMimeTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'File yang diunggah bukan file Excel yang valid.'
            ]);
        }

        $formatter = new PHPExcelFormatter($file);

        $formatterColumns = [
            0 => 'kodesumberperolehan',
            1 => 'kodepenerbit',
            2 => 'kodejenisbuku',
            3 => 'kodesubyek',
            4 => 'judulbuku',
            5 => 'tahun',
            6 => 'jumlahhalaman',
            7 => 'jumlahexemplar',
            8 => 'haripinjam',
            9 => 'isbn',
            10 => 'edisi',
            11 => 'sinopsis',
            12 => 'kodebahasa',
        ];

        $formatter->setFormatterColumns($formatterColumns);

        try {
            $outputArray = $formatter->output('array');
            foreach ($outputArray as $data) {

                $existingCodes = Buku::pluck('kodebuku')->toArray();
                $kodebuku = 1;
                while (in_array($kodebuku, $existingCodes)) {
                    $kodebuku++;
                }

                $databuku = [
                    'kodebuku' => $kodebuku,
                    'kodesumberperolehan' => strval($data['kodesumberperolehan']),
                    'kodepenerbit' => strval($data['kodepenerbit']),
                    'kodejenisbuku' => strval($data['kodejenisbuku']),
                    'kodesubyek' => strval($data['kodesubyek']),
                    'judulbuku' => $data['judulbuku'],
                    'tahun' => strval($data['tahun']),
                    'jumlahhalaman' => strval($data['jumlahhalaman']),
                    'jumlahexemplar' => strval($data['jumlahexemplar']),
                    'haripinjam' => Date::excelToDateTimeObject($data['haripinjam'])->format('Y-m-d'),
                    'isbn' => strval($data['isbn']),
                    'edisi' => $data['edisi'],
                    'filebuku' => "",
                    'sampulbuku' => "",
                    'sinopsis' => $data['sinopsis'],
                    'active' => true,
                    'kodebahasa' => intval($data['kodebahasa']),
                ];

                Buku::create($databuku);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data imported successfully',
                'data' => $outputArray
            ]);
        } catch (PHPExcelFormatterException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error importing data: ' . $e->getMessage(),
            ]);
        }
    }
}
