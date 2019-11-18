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

        $this->call(UsersSeeder::class);

        UserProvider::create([
            'user_id' => 1,
            'rfc' => 'asdajsd31',
            'provider_banner' => null,
            'quotation' => 125.25,
            'description' => '10 years of experience'
        ]);
    }
}
