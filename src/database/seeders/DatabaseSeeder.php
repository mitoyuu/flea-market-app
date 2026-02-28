<?php

namespace Database\Seeders;

use Faker\Provider\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //ここにuserstableのseed
        $this->call(UsersTableSeeder::class);
        //ここにstatusestableのseed
        $this->call(StatusesTableSeeder::class);

        $this->call(ItemsTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(PaymentMethodsTableSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
