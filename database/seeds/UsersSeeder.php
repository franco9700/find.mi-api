<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Rocio',
            'lastname' => 'Sanchez',
            'birthdate' => '1997-03-15',
            'address' => 'Calle 23 Avenida H',
            'phone' => '98765412',
            'email' => 'rocio@gmail.com',
            'password' => 'rocio123',
        ]);
    }
}
