<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 商品一覧
Route::get('/', [ItemController::class, 'index']);

// 商品検索
Route::get('/search', [ItemController::class, 'search']);

// 商品詳細
Route::get('/item/{item}', [ItemController::class, 'show'])
->name('item.show');

// ログイン認証
// ミドルウェア･･･ログインしていない人はアクセス不可・未ログインなら login ページへリダイレクト
Route::middleware('auth')->group(function () {
    // プロフィール ログイン後に必ずここを通す（プロフィール書いた？）
    Route::get('/mypage', [UserController::class, 'mypage']);
    // プロフィール画面（表示）
    // Route::get('/mypage', [UserController::class, 'show']);
    // プロフィール設定・編集画面（表示）
    Route::get('/mypage/profile', [UserController::class, 'edit']);
    // プロフィール設定・編集画面（更新）
    Route::post('/mypage/profile', [UserController::class, 'update']);

    // 商品詳細内（いいね追加）
    Route::post('/items/{item}/favorite', [FavoriteController::class, 'store'])
        ->name('favorite.store');
    // 商品詳細内（いいね削除）
    Route::delete('/items/{item}/favorite', [FavoriteController::class, 'destroy'])
        ->name('favorite.destroy');
    // 商品詳細内（コメント機能）
    Route::post('/items/{item}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    // 商品出品画面（表示）
    Route::get('/sell', [ItemController::class, 'create']);
    // 商品出品（保存）
    Route::post('/sell', [ItemController::class, 'store']);

    // 商品購入画面（表示）
    Route::get('/purchase/{item}', [PurchaseController::class, 'create']);
    // 商品購入確定（保存）
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])
        ->name('purchase.store');

    // 送付先住所変更画面（表示）
    Route::get('/purchase/address/{item}', [PurchaseController::class, 'edit']);
    // 送付先住所変更画面（更新）
    Route::post('/purchase/address/{item}', [PurchaseController::class, 'update']);
});
