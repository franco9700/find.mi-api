<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserProvider;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /*User::create([
            'firstname' => 'Ros',
            'lastname' => 'Sanchez',
            'birthdate' => '1997-04-11',
            'gender' => 'f',
            'address' => 'Calle 23 Avenida H',
            'phone' => '98765412',
            'email' => 'admin@admin.com',
            'password' => 'admin123',
            'score' => 50.25,
            'profile_img' => null,
            'role' => 'admin'
        ]);*/

        UserProvider::create([
            'user_id' => 1,
            'rfc' => 'asdajsd31',
            'provider_banner' => null,
            'quotation' => 125.25,
            'description' => '10 years of experience'
        ]);
    }
}
