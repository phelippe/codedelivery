<?php

use CodeDelivery\Models\Client;
use CodeDelivery\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #Criação de usuário comum
        factory(User::class)->create(
            [
                'name' => 'User',
                'email' => 'user@email.com',
                'password' => bcrypt(1234),
                'remember_token' => str_random(10),
            ]
        )->client()->save(factory(Client::class)->make());

        #Criação de usuário ADMIN
        factory(User::class)->create(
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt(1234),
                'role' => 'admin',
                'remember_token' => str_random(10),
            ]
        )->client()->save(factory(Client::class)->make());

        factory(User::class, 10)->create()->each( function($u) {
            $u->client()->save(factory(Client::class)->make());
        });



        #Criação de usuário ADMIN
        factory(User::class, 3)->create(
            [
                'role' => 'deliveryman',
            ]
        );
    }
}
