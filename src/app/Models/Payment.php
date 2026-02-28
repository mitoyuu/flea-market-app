<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_id',
        'payment_method_id',
    ];

    // Payment は
    // ・User に属する
    // ・Item に属する
    // ・PaymentMethod に属する

    // 誰が支払ったか
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 何を買ったか
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // どの支払い方法か
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
