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
            'birthdate' => '1997-05-15',
            'address' => 'Calle 23 Avenida H',
            'phone' => '98765412',
            'email' => 'rocio@gmail.com',
            'password' => 'rocio123',
            'gender' => 'f',
        ]);

        User::create([
            'firstname' => 'Franco',
            'lastname' => 'Martinez',
            'birthdate' => '1997-08-12',
            'address' => 'Calle 20 Avenida G',
            'phone' => '98456412',
            'email' => 'franco@gmail.com',
            'password' => 'franco123',
            'gender' => 'm',
        ]);

        User::create([
            'firstname' => 'Luis',
            'lastname' => 'Perez',
            'birthdate' => '1975-05-10',
            'address' => 'Calle 8 Avenida B',
            'phone' => '78765412',
            'email' => 'luis@gmail.com',
            'password' => 'luis123',
            'gender' => 'm',
        ]);
    }
}
