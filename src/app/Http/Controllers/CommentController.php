<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    // ？？？？コーチへ確認？？？？
    // $itemを()内に追加するとbladeのhiddenの行は二重になっているため削除できる  どっちが良いのか？ item_id? $item?

    // コメントを 保存
    public function store(CommentRequest $request)
    {
        // dd(Auth::id());
        // dd($request->all());

        $comment = $request->only(['content']);

        // ログインユーザーIDと商品IDをサーバー側で設定
        // 認証ユーザーとコメント対象の商品を紐付ける（実務向け）
        $comment["user_id"] = Auth::id();   // 認証情報から取得
        $comment["item_id"] = $request->item_id; // どの商品へのコメントかを特定

        // データベース保存処理
        Comment::create($comment);

        // 保存したら 元のページに戻る
        return back();
    }
}
