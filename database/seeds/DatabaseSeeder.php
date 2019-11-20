<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UsersProvider;
use App\ServicesCatalogue;
use App\ServicesSubCatalogue;
use App\JobsStatus;
use App\ProvidersCommentary;


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

        UsersProvider::create([
            'user_id' => 1,
            'rfc' => 'asdajsd31',
            'provider_banner' => null,
            'quotation' => 125.25,
            'description' => '10 years of experience'
        ]);

        ServicesCatalogue::create([
            'title' => 'Construcción',
        ]);

        ServicesCatalogue::create([
            'title' => 'Plomería',
        ]);

        ServicesCatalogue::create([
            'title' => 'Salud',
        ]);

        ServicesSubCatalogue::create([
            'services_catalogue_id' => 1,
            'title' => 'Alabañileria',
        ]);

        ServicesSubCatalogue::create([
            'services_catalogue_id' => 1,
            'title' => 'Joteria',
        ]);

        JobsStatus::create([
            'title' => 'Terminado',
        ]);

        JobsStatus::create([
            'title' => 'En procexo',
        ]);

        ProvidersCommentary::create([
            'users_provider_id' => 1,
            'user_id' => 2,
            'content' => 'Excelente servicio, 10/10',
        ]);

        ProvidersCommentary::create([
            'users_provider_id' => 1,
            'user_id' => 3,
            'content' => 'Pesimo servicio, morra meca',
        ]);
    
    }
}
