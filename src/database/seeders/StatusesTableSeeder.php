<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = [
            [
                'content' => '良好',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => '目立った傷や汚れなし',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'やや傷や汚れあり',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => '状態が悪い',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('statuses')->insert($content);
    }
}

