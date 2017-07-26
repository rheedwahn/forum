<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'Ridwan Busari',
            'email' => 'rabusari@gmail.com',
            'password' => bcrypt('adeshina'),
            'admin' => 1,
            'avater' => 'avatar/admin.jpg',
        ]);

        App\User::create([
            'name' => 'Nofisat Busari',
            'email' => 'nofisat@gmail.com',
            'password' => bcrypt('adenike'),
            'avater' => 'avatar/admin.jpg',
        ]);

        App\User::create([
            'name' => 'Ajayi Nurudeen',
            'email' => 'ajayi@nurudeen.com',
            'password' => bcrypt('password'),
            'avater' => 'avatar/admin.jpg',
        ]);
    }
}
