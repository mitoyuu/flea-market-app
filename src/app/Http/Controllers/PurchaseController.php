<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\User;
use App\Models\Status;
use App\Models\PaymentMethod;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    // 商品購入画面（表示）
    public function create(Request $request)
    {
        // ログインしているユーザーを取得
        $user = Auth::user();

        // 支払い選択
        $payment_methods = PaymentMethod::all();

        // URLから item の id を取り出す
        $id = $request->item;

        // 商品 ＋ ユーザーを一緒に取得
        $item = Item::with('user')->findOrFail($id);

        return view('purchase', compact('user', 'item', 'payment_methods'));
    }

    // 送付先住所変更画面（表示）
    public function edit(Request $request)
    {
        // URLから item の id を取り出す
        $id = $request->item;

        // ログインしているユーザーを取得
        $user = Auth::user();

        // 商品データをDBから取ってくる
        // (Item→ items テーブルを見る
        // findOrFail($id)→id = 11 の商品を探す
        // なかったら 自動で404を出す ※変なURLから守る)
        $item = Item::findOrFail($id);

        return view('purchase_address', compact('user', 'item'));
    }

    // 送付先住所変更（更新）
    public function update(AddressRequest $request)
    {
        // dd($request->all());

        // ログインユーザー取得
        $user = Auth::user();

        // 住所更新
        Auth::user()->update([
            'post_code' => $request->post_code,
            'address'   => $request->address,
            'building'  => $request->building,
        ]);

    // 購入画面へ戻る（item付き）
    return redirect('/purchase/' . $request->item);
        }


    // 商品購入処理（保存）
    public function store(PurchaseRequest $request)
    {
        // dd($request->all());

        // ① 商品を取得
        $item = Item::findOrFail($request->item);

        // ② 支払い履歴を保存
        Payment::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'payment_method_id' => $request->payment_method_id,
            // 'amount' => $item->price,
        ]);

        // ③ 商品を「購入済み」にする
        // 購入者のIDを追加（フォームにないデータをサーバー側で補完）
        $item->buyer_id = Auth::id();
        // データベースに保存する
        $item->save();

        // ④一覧画面に戻る
        return redirect('/');
    }
}