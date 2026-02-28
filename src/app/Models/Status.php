<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
        protected $fillable = ['content'];

    // 「Statusは複数のItemを持つ」
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
