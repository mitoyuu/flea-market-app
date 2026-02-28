<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
        protected $fillable = [
        'name',
        'price',
        'user_id',
        'brand',
        'description',
        'img',
        'buyer_id',
        'status_id',
        ];

    // 「Itemは1つのStatusを持つ」
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // 「1つの Item は、複数の Category を持つ」
    public function categories()
    {
        // ！！！！！！！コーチへ確認！！！！！！！！
        // 規約ではアルファベット順で単数系とあるので『 'items_categories'』を削除してテーブル名を変えるべき？→このままでOK
        return $this->belongsToMany(Category::class, 'items_categories');
    }
    // 商品は たくさんのユーザーにいいねされる
    // 中間テーブルがある  お互いに複数 = belongsToMany

    // 誰がこの商品をいいねしたのか（関係を見る用）
    // favoritedUsers = いいねした人たち
    public function favoritedUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    // いいねの実体を操作する用（数・削除用）
    // favorites = この商品のいいねの記録たち
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    //  ⇧  このメソッドでできること
    // $item->favorites()->count();   // いいね数
    // $item->favorites()->delete();  // いいね削除
    }

    // この商品は、このユーザーにいいねされている？
    // （YES / NO を答える用）
    public function isFavoritedBy($user)
    // 「この人（$user）がこの商品をいいねしてるか調べてね」
    {
        if (!$user) {
            return false;
            // 「ログインしてない人はいいねしてるわけないよね」
        }

        return $this->favorites()
        // 「この商品のいいね記録を見に行く」
            ->where('user_id', $user->id)
        // 「その中から、この人の分だけ探す」
            ->exists();
        // 「1つでもあった？」
        // あった → true（1）
        // なかった → false（0）
    }

    // コメントの実体（数・削除用）
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 商品は1人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
