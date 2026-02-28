<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Item;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'post_code',
        'address',
        'building',
        'img',
    ];

    // ユーザーはたくさんの商品を持てる
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    // 購入した商品(ユーザーはたくさんの商品を買える)
    public function buyItems()
    {
        return $this->hasMany(Item::class, 'buyer_id');
    }

    // ユーザーは たくさんの商品をいいねする
    public function favorites()
    {
        return $this->belongsToMany(Item::class, 'favorites');
    }

    // ユーザーは たくさんのコメントを持つ
    // 外部キーは comments 側にある = User は hasMany
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
