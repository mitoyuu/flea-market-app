<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // コーチへ確認したいこと
        // 'created_at' => now(),
        // 'updated_at' => now(),
        // は実務で１つづつ入れるとAIは言ってたけど本当なのか？
        DB::table('categories')->insert([
            [
                'content' => 'ファッション',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => '家電',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'インテリア',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'レディース',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'メンズ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'コスメ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => '本',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'ゲーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'スポーツ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'キッチン',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'ハンドメイド',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'アクセサリー',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'おもちゃ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'ベビー・キッズ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
