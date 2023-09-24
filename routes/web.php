<?php
use App\Http\Controllers\MencobaController;
use App\Http\Controllers\BukuController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/buku', [BukuController::class, 'index']);

Route::get('/boom', [MencobaController::class, 'boomesport']);

Route::get('/about', function () {
    return view('about', [
        "name" => "lala",
        "email" => "lala@gmail.com"
    ]);
});

// Create Buku
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');

// Remove Buku
Route::post('buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

// Edit Buku
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
