<?php

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

use App\Livewire\Admin\Genres;
use App\Livewire\Admin\Records;
use App\Livewire\Demo;
use App\Livewire\Itunes;
use App\Livewire\Shop;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('shop', Shop::class)->name('shop');
Route::view('contact', 'contact')->name('contact');
Route::view('playground', 'playground')->name('playground');
Route::view('under-construction', 'under-construction')->name('under-construction');
Route::view('itunes',Itunes::class)->name('itunes');

// Old version
//Route::get('admin/records', function (){
//    $records = [
//        'Queen - <b>Greatest Hits</b>',
//        'The Rolling Stones - <em>Sticky Fingers</em>',
//        'The Beatles - Abbey Road'
//    ];
//    return view('admin.records.index', [
//        'records' => $records
//    ]);
//});
// New version with prefix and group
Route::middleware(['auth','admin','active'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('genres', Genres::class)->name('genres');
    Route::get('records', Records::class)->name('records');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'active',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
