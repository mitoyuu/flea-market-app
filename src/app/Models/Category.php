<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    // 「このカテゴリにはどんな商品がある？」
    public function items()
    {
        // ！！！！！！！コーチへ確認！！！！！！！！
        // 規約ではアルファベット順で単数系とあるので『 'items_categories'』を削除してテーブル名を変えるべき？→このままでOK
        return $this->belongsToMany(Item::class, 'items_categories');
    }
}
