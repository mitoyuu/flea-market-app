<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
        [
            'name' => '腕時計',
            'price' => 15000,
            'user_id'=> 1,
            'brand' => 'Rolax',
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'buyer_id' => 2,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'HDD',
            'user_id' => 1,
            'price' => 5000,
            'brand' => '西芝',
            'description' => '高速で信頼性の高いハードディスク',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
            'buyer_id' => 2,
            'status_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),

            ],
        [
            'name' => '玉ねぎ',
            'user_id' => 1,
            'price' => 300,
            'brand' => 'なし',
            'description' => '新鮮な玉ねぎ3束のセット',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
            'status_id' => 3,
            'buyer_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => '革靴',
            'user_id' => 2,
            'price' => 4000,
            'brand' => null,
            'description' => 'クラシックなデザインの革靴',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
            'buyer_id' => 1,
            'status_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'ノートPC',
            'user_id' => 2,
            'price' => 45000,
            'brand' => null,
            'description' => '高性能なノートパソコン',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
            'buyer_id' => 1,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => ' マイク',
            'user_id' => 1,
            'price' => 8000,
            'brand' => 'なし',
            'description' => '高音質のレコーディング用マイク',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'buyer_id' => null,
            'status_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'ショルダーバッグ',
            'user_id' => 3,
            'price' => 3500,
            'brand' => null,
            'description' => 'おしゃれなショルダーバッグ',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'buyer_id' => 2,
            'status_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'タンブラー',
            'user_id' => 3,
            'price' => 500,
            'brand' => 'なし',
            'description' => '使いやすいタンブラー',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
            'buyer_id' => 1,
            'status_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'コーヒーミル',
            'user_id' => 1,
            'price' => 4000,
            'brand' => 'Starbacks',
            'description' => '手動のコーヒーミル',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
            'buyer_id' => 2,
            'status_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'メイクセット',
            'user_id' => 2,
            'price' => 2500,
            'brand' => null,
            'description' => '便利なメイクアップセット',
            'img' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
            'buyer_id' => 3,
            'status_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        ]);
    }
}
