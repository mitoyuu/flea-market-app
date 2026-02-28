<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
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
                'content' => 'コンビニ払い',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'カード支払い',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('payment_methods')->insert($content);
    }
}
