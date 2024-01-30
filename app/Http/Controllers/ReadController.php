<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;
use setasign\Fpdi\Tcpdf\Fpdi;

class ReadController extends Controller
{
    public function read_pdf($id)
    {
        $buku = Buku::where('kodebuku', $id)->firstOrFail();
        $pdfPath = storage_path('app/' . $buku->filebuku);

        $pdf = file_get_contents($pdfPath);
        $countPages = preg_match_all("/\/Page\W/",$pdf,$dummy);

        $view_data = [
            'kodebuku' => $id,
            'countPages' => $countPages,
            'judulbuku' => $buku->judulbuku
        ];

        return view('baca.index', $view_data);
    }

    //==============================================================================

    public function render_pdf($id, $page)
    {
        // Mengambil dan merender PDF sesuai dengan nomor halaman
        $pdf = $this->renderPdf($id, $page);

        // Enkripsi nomor halaman untuk nama file
        $encryptedPageNumber = encrypt($page);

        // Mengembalikan file PDF sebagai respons
        return Response::make($pdf, 200, [
            'Content-Type' => 'application/json',
        ]);
    }

    private function renderPdf($id, $pageNumber)
    {
    // mengambil data yang sesuai
    $file = Buku::where('kodebuku', $id)->firstOrFail();

    // Path ke file PDF asli
    $pdfPath = storage_path('app/' . $file->filebuku);

    // Create instance FPDI
    $pdf = new FPDI();

    // Mengambil file dari storage
    $pdf->setSourceFile($pdfPath);

    // Import halaman PDF
    $tplId = $pdf->importPage($pageNumber);

    // Tambahkan halaman baru
    $pdf->AddPage();

    // Gunakan template halaman yang diimpor
    $pdf->useTemplate($tplId);

    // Enkripsi akses ke halaman PDF
    $encryptedPageNumber = encrypt($pageNumber);

    // Output PDF ke string
    ob_start();
    $pdf->Output('S');
    $pdfContent = ob_get_clean();

    return $pdfContent;
    }

}
