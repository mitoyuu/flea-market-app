<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Item;
use App\Models\Status;
use App\Models\Category;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // 商品一覧画面
    // public function index()
    // {
    //     // DBから全商品を取得（Seederで入れた10件の商品が $items に入る）
    //     $items = Item::all();
    //     return view('index', compact('items'));
    // }

    // public function index(Request $request)
    // {
    // // どの一覧を表示するか（デフォルトはおすすめ）
    // $tab = $request->query('tab', 'recommend');

    // // ログインユーザーを取得（未ログインなら null）
    // $user = auth()->user();

    // // 表示する商品を入れる箱(未ログイン時のマイリスト用)
    // $items = collect();

    // // --- おすすめ ---
    // if ($tab === 'recommend') {

    //     // 商品を探す準備スタート
    //     $items = Item::query()
    //         // 「もしログインしてたら」自分の出品商品は除外
    //         // 未ログインならこの条件は自動スキップ
    //         ->when($user, function ($query) use ($user) {
    //             $query->where('user_id', '!=', $user->id);
    //         })
    //         // 新しい順に
    //         ->latest()
    //         // 全部取る
    //         ->get();
    // }

    // // --- マイリスト ---
    // if ($tab === 'mylist') {

    //     // ログインしている場合のみ取得
    //     if ($user) {
    //         // 「このユーザーがいいねした商品だけ探す」
    //         $items = Item::whereHas('favorites', function ($query) use ($user) {
    //                 $query->where('user_id', $user->id);
    //             })
    //             ->latest()
    //             ->get();
    //     }
    //     // 未ログインなら $items は空のまま（何も表示されない）
    // }
    // // $items → 表示する商品  $tab → タブのON/OFF用
    // return view('index', compact('items', 'tab'));
    // }

    public function index(Request $request)
    {
        // URLに tab があればそれを使い、なければ recommend（おすすめ） にする
        $tab = $request->query('tab', 'recommend');
        // 「今ログインしてる人は誰？」
        $user = auth()->user();
        // ※ログイン中 → $user にユーザー情報が入る
        // ※未ログイン → $user = null

        // 「もし今のタブが マイリスト だったら？」
        if ($tab === 'mylist') {

            // マイリスト

            // ログインしているかチェック
            if ($user) {
                // 「このユーザーがいいねした商品だけ探す」
                $items = Item::whereHas('favorites', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                    // 新しい順に並べる
                    // ->latest()
                    // 全部持ってきて $items に入れる
                    ->get();

            // ログインしてなければマイリストは見せられない
            } else {
                $items = collect(); // 未ログインは空っぽの箱
                // ＝未ログインなら $items は空のまま（何も表示されない）

            }
        // それ以外（マイリストじゃない＝おすすめ）
        } else {

            // おすすめ
            // 商品を探す準備スタート
            $items = Item::query()
                // ログインしていたら自分の出品商品は表示しない
                // （未ログインならこの条件はスキップされる）
                ->when($user, function ($query) use ($user) {
                    $query->where('user_id', '!=', $user->id);
                })
                // ->latest()
                ->get();
        }
        // $items → 表示する商品  $tab → タブのON/OFF用
        return view('index', compact('items', 'tab'));
    }

    // 商品詳細画面
    public function show(Request $request)
    {
        // ※モデルルートバインディング(Item $item)を使用しない記述

        // URLパラメータから item の id を取り出す
        $id = $request->item;

        // 商品に紐づくコメント・いいね数・コメント内容
        // 商品取得時にコメント・いいね数・コメント内容も一緒に取得（箱に入れる）
        $item = Item::with('comments.user') // コメント＆その先のユーザーも一緒に取ってくる
                    ->withCount('comments', 'favorites')
                    ->find($id);
        // withCount＝Itemモデルに生えているメソッド名（＝リレーション名）を渡す

        // ※すでに取得されている $item にcomments の「件数」だけを後から読み込む場合 → $item->loadCount('comments');

        // 見つかった $item を詳細画面（item.blade.php）に渡す
        return view('item', compact('item'));
    }

    // 商品出品画面表示
    public function create()
    {
        $categories = Category::all();

        $statuses = Status::all();

        return view('sell',compact('categories','statuses'));
    }

    // 商品出品保存
    public function store(ExhibitionRequest $request)
    {
        // ① 入力データ取得（画像以外）
        $itemData = $request->only([
            'name',
            'price',
            'brand',
            'description',
            'status_id',
        ]);

        // ②ログインユーザーIDを追加（フォームにないデータをサーバー側で補完）
        $itemData["user_id"] = Auth::id();

        // ③ 画像がある場合のみ保存
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('items', 'public');
            $itemData['img'] = $path; // ← DBにはパスだけ
        }

        // $item は、Itemモデル（クラス）を使って$itemData の内容で作成された“新しい商品1件分のデータ” を持つItemモデルのインスタンス
        // ④ DBに商品保存
        $item = Item::create($itemData);

        // ⑤ 中間テーブル（カテゴリ）
        $item->categories()->sync($request->category_ids);

        return redirect('/');
    }

    // // 商品検索
    // public function search(Request $request)
    // {
    //     $items = Item::where('name', 'LIKE',"%{$request->input}%")->get();
    //     $param = [
    //         'input' => $request->input,
    //         'items' => $items
    //     ];
    //     return view('index', $param);
    //     // 実務・応用では when()も使用し条件分岐を明示（安全・拡張向け）
    // }

    // 商品検索
    public function search(Request $request)
    {
        // ① 検索ワードを取り出す
        $keyword = $request->input('input');

        // ② 商品名から部分一致でDBから探す
        $items = Item::where('name', 'LIKE', "%{$keyword}%")
            ->get();

        // ③ index.blade.php に渡すデータをそろえる
        $param = [
            'input' => $keyword,
            'items' => $items,
            'tab'   => 'recommend', // 検索結果はおすすめ扱い
        ];

        // ④ 一覧画面を表示
        return view('index', $param);
    }

    // // 商品検索
    // public function search(Request $request)
    // {
    //     // ① 検索ワード
    //     $keyword = $request->input('input');

    //     // ② 今どのタブか（なければおすすめ）
    //     $tab = $request->query('tab', 'recommend');

    //     // ③ ログインユーザー
    //     $user = auth()->user();

    //     // ④ タブごとに検索対象を分ける
    //     if ($tab === 'mylist' && $user) {
    //         // マイリスト内検索
    //         $items = Item::whereHas('favorites', function ($query) use ($user) {
    //             $query->where('user_id', $user->id);
    //         })
    //             ->where('name', 'LIKE', "%{$keyword}%")
    //             ->get();
    //     } else {
    //         // おすすめ検索
    //         $items = Item::where('name', 'LIKE', "%{$keyword}%")
    //             ->get();
    //     }

    //     // ⑤ view に渡す（index と同じ変数をそろえる）
    //     return view('index', [
    //         'items' => $items,
    //         'input' => $keyword,
    //         'tab'   => $tab,
    //     ]);
    // }
}

