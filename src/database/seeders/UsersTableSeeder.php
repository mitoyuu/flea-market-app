<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ダミーデータ10件作成
        // User::factory()->count(10)->create();
        DB::table('users')->insert([
            [
                'name' => '清野菜名',
                'email' => 'nana77@gmail.com',
                'password' => Hash::make('77777777'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '田中宏樹',
                'email' => 'lbmhiroki@gmail.com',
                'password' => Hash::make('11111111'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'カナタタケヒロ',
                'email' => 'lbmkinta@gmail.com',
                'password' => Hash::make('22222222'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
