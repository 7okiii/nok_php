<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\PostController;
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
    return view('auth.login');
});

Route::get('/dashboard', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 商品登録
Route::post('/save', [ProductController::class, 'create'])->name('product.create');

// 商品名編集
Route::post('/dashboard/update', [ProductController::class, 'update']);

// 商品削除
Route::post('/dashboard/delete', [ProductController::class, 'destroy']);

// 商品並び替え
Route::get('/dashboard/sort', [ProductController::class, 'sort']);

// csv書き出し
Route::get('/export_csv', [CsvController::class, 'export']);

// csvページ表示
Route::get('/csv_upload_form', [CsvController::class, 'index'])->name('csv.index');

// csvアップロード
Route::post('/csv_upload', [CsvController::class, 'import'])->name('csv.import');

// カレンダー表示
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

// 商品検索
Route::get('/search', [ProductController::class, 'search'])->name('product.search');



// 投稿
Route::prefix('post')->group(function () {
    // 初期表示
    Route::get('/', [PostController::class, 'index'])->name('post.index');

    // 新規投稿
    Route::post('/new', [PostController::class, 'create'])->name('post.create');

    // 投稿編集初期表示
    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');

    // 投稿編集
    Route::post('/edit', [PostController::class, 'update'])->name('post.update');

    // 投稿削除（非同期）
    Route::post('/delete', [PostController::class, 'delete'])->name('post.delete');

    // 投稿削除
    Route::get('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    // 投稿画像削除
    Route::get('/delete/image/{id}', [PostController::class, 'deleteImage'])->name('post.deleteImage');
});


require __DIR__.'/auth.php';