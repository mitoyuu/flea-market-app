<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mime\Address;
use App\Http\Requests\ProfileRequest;



class UserController extends Controller
{
// プロフィール（表示専用）
    public function mypage(Request $request)
    {
        // 今ログインしている人を取ってくる
        $user = Auth::user();

        // page パラメータ（デフォルトは sell）
        $page = $request->query('page', 'sell');

        // 買ったものを見たい？
        if ($page === 'buy') {
            // 買った商品を集める
            $items = $user->buyItems;
            // dd($items); 入っているかチェック

        // それ以外は出品した商品を見せる
        } else {
            $items = $user->items; // 出品した商品
        }
        // 誰のページか、どの商品か、今どのタブか全部まとめて画面に渡す
        return view('mypage', compact('user', 'items', 'page'));
    }



    // // プロフィール画面（表示）
    // public function show()
    // {
    //     $user = Auth::user();

    //     return view('mypage',compact('user'));
    // }

    // プロフィール設定・編集画面（表示）
    public function edit()
    {
        $user = Auth::user();

        return view('mypage_profile', compact('user'));
    }

    // プロフィール設定・編集画面（更新）
    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        // ① 文字データを保存
        $user->update([
            'name' => $request->name,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        // ② 画像があるときだけ保存
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('users', 'public');
            $user->update([
                'img' => 'storage/' . $path,
            ]);
        }

        return redirect('/');
    }
}

