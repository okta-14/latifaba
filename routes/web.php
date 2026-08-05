<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\VideoFrontController;
use App\Http\Controllers\AlbumDetailController;
use App\Http\Controllers\BlogDetailController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\adminController\UserController;
use App\Http\Controllers\adminController\AdminController;
use App\Http\Controllers\adminController\PengaturanController;
use App\Http\Controllers\adminController\MediaController;
use App\Http\Controllers\adminController\VideoController;
use App\Http\Controllers\adminController\AlbumAdminController;
use App\Http\Controllers\adminController\KategoriController;
use App\Http\Controllers\adminController\KategoriProjectController;
use App\Http\Controllers\adminController\ClientController;
use App\Http\Controllers\adminController\KontakKamiController;
use App\Http\Controllers\adminController\ServiceController;
use App\Http\Controllers\adminController\TagsController;
use App\Http\Controllers\adminController\BlogAdminController;
use App\Http\Controllers\adminController\FotoController;
use App\Http\Controllers\adminController\ProgramAdminController;
use App\Http\Controllers\adminController\ProjectFotoController;
use App\Http\Controllers\adminController\ReviewAdminController;
use App\Http\Controllers\adminController\GroupCompaniesController;
// ================ Frontend Route =================//
Route::get('/', [LandingPageController::class, 'index'])->name('landingPage');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/members', [MembersController::class, 'members'])->name('members');
Route::get('/program', [ProgramController::class, 'index'])->name('program');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/videofront', [VideoFrontController::class, 'index'])->name('videofront');
Route::get('/album', [AlbumController::class, 'index'])->name('album');
Route::get('/album/{slug}', [AlbumDetailController::class, 'detail'])
    ->name('albumDetail');
Route::get('/blog/{slug}',[BlogDetailController::class,'detail'])->name('blogDetail');
Route::get('/tag/{slug}',[BlogDetailController::class,'tag'])->name('tag');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::post('/videofront/hit/{video}', [VideoFrontController::class, 'incrementHit'])
    ->name('videofront.hit');
Route::get('/review/create', [ReviewController::class, 'create'])
    ->name('review.create');
Route::post('/review', [ReviewController::class, 'store'])
    ->name('review.store');
   

// ================ login =================//
Route::get('/login',[LoginController::class,'index'])->name('login');

Route::post('/login',[LoginController::class,'login'])->name('login.post');

Route::post('/logout',[LoginController::class,'logout'])->name('logout');

// ================ LOGIN DULU BARU BOLEH MASUK ADMIN =================//

// Semua user yang sudah login boleh masuk dashboard
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('user.index');
    })->middleware('auth')->name('admin');
});

// ================= KHUSUS ADMIN =================
Route::middleware(['auth', 'level:admin'])->group(function () {

    Route::resource('user', UserController::class);
    Route::resource('pengaturan', PengaturanController::class);

});

// ================= ADMIN + PETUGAS =================
Route::middleware(['auth', 'level:admin,petugas'])->group(function () {

    Route::resource('media', MediaController::class);
    Route::resource('video', VideoController::class);
    Route::resource('albumadmin', AlbumAdminController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('kategoriProject', KategoriProjectController::class);
    Route::resource('client', ClientController::class);
    Route::resource('kontakkami', KontakKamiController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('tags', TagsController::class);
    Route::resource('blogadmin', BlogAdminController::class);
    Route::resource('foto', FotoController::class);
    Route::resource('programadmin', ProgramAdminController::class);
    Route::resource('projectfoto', ProjectFotoController::class);
    Route::resource('reviewadmin', ReviewAdminController::class);
    Route::resource('groupcompanies', GroupCompaniesController::class);

});

Route::get('/lang/{locale}', function (string $locale) {
    $available = ['id', 'en', 'jp'];

    if (in_array($locale, $available)) {
        session(['locale' => $locale]);
    }

    return back();
})->name('lang.switch');