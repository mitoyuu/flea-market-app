<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
    ];

    // 支払い方法は複数の支払いを持つ
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
