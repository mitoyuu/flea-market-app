<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            // user_id: 外部キー制約
            $table->foreignId('user_id')->constrained('users');
            // 商品名
            $table->string('name', 255);
            // 商品の説明
            $table->text('description')->nullable();
            // 販売価格
            $table->integer('price');
            // 商品の状態
            // status_id: 相手のテーブル(statuses)のID型に合わせる
            $table->foreignId('status_id')->constrained('statuses');
            // ブランド名
            $table->text('brand')->nullable();
            // 商品画像
            $table->string('img')->nullable();
            // buyer_id: ユーザーID（購入者）を参照。null許可（未購入時）
            $table->foreignId('buyer_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
