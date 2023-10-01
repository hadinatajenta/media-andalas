<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AdminBeritaController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\PengiklanController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;

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


// halaman utama
Route::get('/',[HomePageController::class, 'index'])->name('home');
//Halaman baca berita (detail berita)
Route::get('/single/{slug}', [ReadingController::class, 'show'])->name('single.show');
//Halaman disclaimer berita
Route::get('/disclaimer', [WebsiteController::class, 'showDisclaimer']);
//Halaman kontak kami
Route::get('/kontak', [WebsiteController::class, 'showKontakPage']);
//Halaman Redaksi
Route::get('/redaksi', [WebsiteController::class, 'showRedaksiPage']);



// auth middlware
Auth::routes();

//Role Admin
Route::middleware(['role:admin'])->group(function () {

    //Halaman admin
    Route::prefix('admin')->group(function () {
        //Halaman dashboard admin
        Route::get('/dashboard', [AdminBeritaController::class, 'search'])->name('admin.dashboard');
        //Halaman tambah berita
        Route::get('/buat',[AdminBeritaController::class, 'create'])->name('admin.create');
        //Menyimpan berita
        Route::post('/buat',[AdminBeritaController::class, 'store'])->name('admin.store');
        //menjadikan featured news
        Route::get('/dashboard/{id}', [AdminBeritaController::class, 'makeFeatured'])->name('admin.makeFeatured');
        //menghapus featured news
        Route::get('/dashboard/remove/{id}', [AdminBeritaController::class, 'removeFeatured'])->name('admin.removeFeatured');
        //menghapus berita
        Route::delete('/dashboard/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.destroy');      
        
        //Halaman statistik admin
        Route::get('/statistik', [StatisticsController::class, 'showStatistics'])->name('admin.showStatistics');
        Route::get('/statistik/{period}', [StatisticsController::class, 'showStatistics']);
        Route::get('/statistik/data/{period}', [StatisticsController::class, 'getChartData']);
        
        //Halaman Manajemen author
        Route::get('/manajemen-author', [UsersController::class, 'index'])->name('admin.author');
        //Tambah author
        Route::post('/manajemen-author', [UsersController::class, 'store'])->name('author.store');
        //Update author
        Route::put('/manajemen-author/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/manajemen-author/delete/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

        
        //Halaman berita menunggu persetujuan.
        Route::prefix('/management-berita')->group(function () {
            //Halaman detail berita menunggu persetujuan.
            Route::get('/detail-berita-menunggu-persetujuan/{id}', [StatusController::class,'show'])->name('admin.berita.detail');
            //Halaman edit berita menunggu persetujuan.
            Route::put('/detail-berita-menunggu-persetujuan/{id}', [StatusController::class,'update'])->name('admin.berita.update');
        
        });

        //Halaman kategori
        Route::prefix('kategori')->group(function () {
            //Halaman kategori
            Route::get('/', [KategoriController::class, 'index'])->name('admin.index');
            //Tambah kategori
            Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
            //Update kategori
            Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            //Hapus kategori
            Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
            
        });

        //Halaman manajemen Iklan
        Route::prefix('management-iklan')->group(function () {
            //Halaman iklan dari IklanController
            Route::get('/iklan/{order?}', [IklanController::class, 'index'])->name('admin.iklan');
            //Update Informasi Iklan
            Route::put('/iklan/{id}', [IklanController::class, 'update'])->name('admin.iklan.update');
            // Halaman tambah pengiklan
            Route::get('/tambah-pengiklan', [PengiklanController::class, 'create'])->name('admin.tambah-pengiklan');
            // Halaman simpan data pengiklan dari halaman tambah-pengiklan
            Route::post('/tambah-pengiklan', [PengiklanController::class, 'store'])->name('admin.store-pengiklan');
            // Total harga iklan dari data pengiklan
            Route::post('/get-harga-iklan', [PengiklanController::class, 'getHargaIklan'])->name('get.harga.iklan');
            // Halaman edit pengiklan
            Route::get('/edit-pengiklan/{id}', [PengiklanController::class, 'edit'])->name('admin.edit-pengiklan');
            // Update data pengiklan
            Route::put('/edit-pengiklan/{id}', [PengiklanController::class, 'update'])->name('admin.update-pengiklan');
        });

        //PENGATURAN AKUN
        Route::prefix('pengaturan')->group(function () {
            //Halaman profile admin
            Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
            //Update profile admin
            Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        });

        //PENGATURAN WEBSITE
        Route::prefix('settings')->group(function () {
            //Halmaan pengaturan website
            Route::get('/pengaturan-website', [WebsiteController::class, 'index'])->name('admin.pengaturan-website.index');
            //Edit halaman website
            Route::put('/pengaturan-website', [WebsiteController::class, 'update'])->name('admin.pengaturan-website.update');
        });
    });
});

//Role Author
Route::middleware(['role:author'])->group(function () {
    //Halaman dashboard author
    Route::get('/author/dashboard', [BeritaController::class, 'index'])->name('author.dashboard');
    //Halaman tambah berita
    Route::get('/author/tambah-berita', [BeritaController::class, 'create'])->name('author.tambah-berita');
    // menyiapkan data Baru
    Route::post('/author/tambah-berita', [BeritaController::class, 'store'])->name('author.store-berita');
    //Halaman edit berita
    Route::get('/author/management-berita/edit/{id}',[BeritaController::class, 'edit'])->name('author.edit');
    //menyimpan data update berita
    Route::put('/author/management-berita/edit/{id}',[BeritaController::class, 'update'])->name('author.update');
    //Menghapus berita
    Route::delete('/author/management-berita/{id}',[BeritaController::class, 'destroy'])->name('author.destroy');
    //Halaman profile admin
    Route::get('/author/pengaturan/profile',[ProfileController::class, 'edit'])->name('author.profile.edit');
    //Update profile admin
    Route::post('/author/pengaturan/profile',[ProfileController::class, 'update'])->name('author.profile.update');
});