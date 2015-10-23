<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(OAuthTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(OrderItemTableSeeder::class); #feito por mim
        $this->call(CupomTableSeeder::class);

        Model::reguard();
    }
}
