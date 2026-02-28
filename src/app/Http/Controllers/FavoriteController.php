<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // いいねを「保存」する
    public function store(Request $request)
    {
        // URLパラメータから item の id を取り出す
        $id = $request->item;

        // ログインしているユーザーが
        // この商品にいいねを保存する
        Auth::user()->favorites()->attach($id);

        // 元の画面に戻る
        return back();
    }

    // いいねを「削除」する
    public function destroy(Request $request)
    {
        // URLパラメータから item の id を取り出す
        $id = $request->item;

        // favoritesテーブルから
        // 「この商品 × このユーザー」のいいねを削除
        Favorite::where('item_id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        // 元の画面に戻る
        return back();
    }
}
