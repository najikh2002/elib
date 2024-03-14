<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//==================================================================================
//==================================================================================

Route::middleware(['isGuest'])->group(function () {
    Route::get('/', [AuthController::class, 'home'])->name('welcome');
    Route::get('/refresh', [UserController::class, 'refresh']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
    Route::get('/cari', [SearchController::class, 'caribuku']);
    Route::get('/category/{jenisbuku}', [SearchController::class, 'carijenisbuku']);
});

Route::middleware(['isLogin'])->group(function () {
    Route::get("/user/pinjam/{id}", [UserController::class,"pinjambuku"])->name("pinjam");
    Route::delete("/user/hapus-sesi/{id}", [UserController::class,"batalpinjambuku"])->name("batal-pinjam");
    Route::get("/user/baca", [UserController::class,"bacabuku"])->name("baca");
    Route::get('/logged', [AuthController::class, 'logged']);
    Route::get('/home', [AuthController::class,'user'])->name('user')->middleware('isSeller');
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/profile-password',[UserController::class,'updatepasswordprofile']);
    Route::post('/profile-photo',[UserController::class,'updatephotoprofile']);

    // detail buku
    Route::prefix('detail')->group(function () {
        Route::get('/{id}', [UserController::class, 'detailbuku']);
        Route::get('/{id}/read', [ReadController::class, 'read_pdf']);
        Route::get('/{id}/{page}/read', [ReadController::class, 'render_pdf']);
    });
});


Route::middleware('isLogin')->middleware('isSellerApi')->group(function() {
    Route::prefix('seller')->group(function() {
        Route::get('/', [SellerController::class,'index'])->name('seller');
        Route::get('/buku', [SellerController::class,'buku'])->name('buku');
        Route::get('/pengarang', [SellerController::class,'pengarang'])->name('pengarang');
        Route::get('/jenisbuku', [SellerController::class,'jenisbuku'])->name('jenisbuku');
        Route::get('/subyek', [SellerController::class,'subyek'])->name('subyek');
        Route::get('/penerbit', [SellerController::class,'penerbit'])->name('penerbit');
        Route::get('/bahasa', [SellerController::class,'bahasa'])->name('bahasa');
        Route::get('/anggota', [SellerController::class,'anggota'])->name('anggota');
        Route::get('/sumberperolehan', [SellerController::class,'sumberperolehan'])->name('sumber-perolehan');
        Route::get('/laporan-{laporan}', [SellerController::class,'laporan']);
    });
});

Route::middleware('isSellerApi')->group(function() {
    // CHART
    Route::prefix('data')->group(function(){
        Route::get('totalpengunjung', [ChartController::class, 'totalpengunjung']);
        Route::get('baca', [ChartController::class, 'baca']);
        Route::get('totalpinjamanggota', [ChartController::class, 'totalpinjamanggota']);
        Route::get('totalbacaperbuku', [ChartController::class, 'totalbacaperbuku']);
        Route::get('totalanggota', [ChartController::class, 'totalanggota']);
    });

    // IMPORT SERVICE
    Route::prefix('import')->group(function(){
        Route::post('anggota', [ImportController::class, 'importanggota']);
        Route::post('buku', [ImportController::class, 'importbuku']);
    });

    // SERVICE SEARCH
    Route::prefix('cari')->group(function() {
        Route::get('/sumberperolehan/{nama}', [SellerController::class,'carisumberperolehan']);
        Route::get('/pengarang/{nama}', [SellerController::class,'caripengarang']);
        Route::get('/penerbit/{nama}', [SellerController::class,'caripenerbit']);
        Route::get('/jenisbuku/{nama}', [SellerController::class,'carijenisbuku']);
        Route::get('/subyek/{nama}', [SellerController::class,'carisubyek']);
        Route::get('/bahasa/{nama}', [SellerController::class,'caribahasa']);
    });

    // SERVICE ACTION
    Route::prefix('seller')->group(function() {
        // ANGGOTA SERVICE -->
        Route::post('/buatanggota', [SellerController::class,'buatanggota']);
        Route::post('/updateanggota', [SellerController::class,'updateanggota']);
        Route::get('/editanggota/{id}', [SellerController::class,'editanggota']);

        // BAHASA SERVICE
        Route::get('/listbahasa', [SellerController::class,'listbahasa']);
        Route::post('/buatbahasa', [SellerController::class,'buatbahasa']);
        Route::post('/updatebahasa', [SellerController::class,'updatebahasa']);
        Route::get('/editbahasa/{id}', [SellerController::class,'editbahasa']);

        // SUMBER PEROLEHAN SERVICE
        Route::get('/listsumberperolehan', [SellerController::class,'listsumberperolehan']);
        Route::post('/buatsumberperolehan', [SellerController::class,'buatsumberperolehan']);
        Route::post('/updatesumberperolehan', [SellerController::class,'updatesumberperolehan']);
        Route::get('/editsumberperolehan/{id}', [SellerController::class,'editsumberperolehan']);

        // FILE PDF SERVICE
        Route::post('/file-pdf', [SellerController::class,'filepdf']);

        // BUKU SERVICE
        Route::post('/buatbuku', [SellerController::class,'buatbuku']);
        Route::post('/updatebuku', [SellerController::class,'updatebuku']);
        Route::get('/editbuku/{id}', [SellerController::class,'editbuku']);

        // JENIS BUKU SERVICE
        Route::get('/listjenisbuku', [SellerController::class,'listjenisbuku']);
        Route::post('/buatjenisbuku', [SellerController::class,'buatjenisbuku']);
        Route::post('/updatejenisbuku', [SellerController::class,'updatejenisbuku']);
        Route::get('/editjenisbuku/{id}', [SellerController::class,'editjenisbuku']);

        // BAHASA SERVICE
        Route::get('/listbahasa', [SellerController::class,'listbahasa']);
        Route::post('/buatbahasa', [SellerController::class,'buatbahasa']);
        Route::post('/updatebahasa', [SellerController::class,'updatebahasa']);
        Route::get('/editbahasa/{id}', [SellerController::class,'editbahasa']);

        // PENGARANG SERVICE
        Route::get('/listpengarang', [SellerController::class,'listpengarang']);
        Route::post('/buatpengarang', [SellerController::class,'buatpengarang']);
        Route::post('/updatepengarang', [SellerController::class,'updatepengarang']);
        Route::get('/editpengarang/{id}', [SellerController::class,'editpengarang']);

        // SUBYEK SERVICE
        Route::get('/listsubyek', [SellerController::class,'listsubyek']);
        Route::post('/buatsubyek', [SellerController::class,'buatsubyek']);
        Route::post('/updatesubyek', [SellerController::class,'updatesubyek']);
        Route::get('/editsubyek/{id}', [SellerController::class,'editsubyek']);

        // PENERBIT SERVICE
        Route::get('/listpenerbit', [SellerController::class,'listpenerbit']);
        Route::post('/buatpenerbit', [SellerController::class,'buatpenerbit']);
        Route::post('/updatepenerbit', [SellerController::class,'updatepenerbit']);
        Route::get('/editpenerbit/{id}', [SellerController::class,'editpenerbit']);
    });
});

Route::middleware('isSellerApi')->group(function() {
    Route::prefix('seller')->group(function() {
        Route::delete('/buku/{buku}', [SellerController::class,'hapusbuku']);
        Route::delete('/jenisbuku/{jenisbuku}', [SellerController::class,'hapusjenisbuku']);
        Route::delete('/pengarang/{pengarang}', [SellerController::class,'hapuspengarang']);
        Route::delete('/subyek/{subyek}', [SellerController::class,'hapussubyek']);
        Route::delete('/penerbit/{penerbit}', [SellerController::class,'hapuspenerbit']);
        Route::delete('/bahasa/{bahasa}', [SellerController::class,'hapusbahasa']);
        Route::delete('/sumberperolehan/{sumberperolehan}', [SellerController::class,'hapussumberperolehan']);
        Route::delete('/anggota/{anggota}', [SellerController::class,'hapusanggota']);
    });
});
