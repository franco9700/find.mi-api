<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UsersProvider;
use App\ServicesCatalogue;
use App\ServicesSubCatalogue;
use App\JobsStatus;
use App\ProvidersCommentary;
use App\ProvidersService;
use App\Job;


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
            'rfc' => 'AD78WE25XC45',
            'provider_banner' => null,
            'quotation' => 125.25,
            'description' => '10 years of experience'
        ]);

        UsersProvider::create([
            'user_id' => 2,
            'rfc' => 'XCC12SD87QPL5',
            'provider_banner' => null,
            'quotation' => null,
            'description' => '20 years of experience'
        ]);

        ServicesCatalogue::create([
            'title' => 'Construcción',
        ]);

        ServicesCatalogue::create([
            'title' => 'Carpintería',
        ]);

        ServicesCatalogue::create([
            'title' => 'Electricidad',
        ]);

        ServicesCatalogue::create([
            'title' => 'Fumigación',
        ]);

        ServicesCatalogue::create([
            'title' => 'Herrería',
        ]);

        ServicesCatalogue::create([
            'title' => 'Jardinería',
        ]);

        ServicesCatalogue::create([
            'title' => 'Limpieza en general',
        ]);

        ServicesCatalogue::create([
            'title' => 'Pintura',
        ]);

        ServicesCatalogue::create([
            'title' => 'Plomería',
        ]);

        ServicesCatalogue::create([
            'title' => 'Seguridad',
        ]);

        ServicesCatalogue::create([
            'title' => 'Tecnología',
        ]);

        JobsStatus::create([
            'title' => 'Pendiente de respuesta',
        ]);

        JobsStatus::create([
            'title' => 'En proceso',
        ]);

        JobsStatus::create([
            'title' => 'Terminado',
        ]);

        ProvidersCommentary::create([
            'users_provider_id' => 1,
            'user_id' => 3,
            'content' => 'Excelente servicio',
        ]);

        ProvidersCommentary::create([
            'users_provider_id' => 1,
            'user_id' => 4,
            'content' => 'Pesimo servicio',
        ]);

        ProvidersService::create([
            'user_id' => 1,
            'services_catalogue_id' => 1,
        ]);

        ProvidersService::create([
            'user_id' => 1,
            'services_catalogue_id' => 2,
        ]);

        ProvidersService::create([
            'user_id' => 2,
            'services_catalogue_id' => 2,
        ]);

        Job::create([
            'user_id' => 2,
            'jobs_status_id' => 1,
            'providers_service_id' => 1,
            'short_description' => 'Ayuda con enyesado',
            'detailed_description' => 'Necesito un experto en enyesado. Necesito un experto en enyesado. Necesito un experto en enyesado. Necesito un experto en enyesado.
            Necesito un experto en enyesado. Necesito un experto en enyesado.'
        ]);

        Job::create([
            'user_id' => 2,
            'jobs_status_id' => 2,
            'providers_service_id' => 2,
            'short_description' => 'Fabricar puerta',
            'detailed_description' => 'Solicito ayuda con fabricación de puerta de cierta madera. Solicito ayuda con fabricación de puerta de cierta madera. Solicito ayuda con fabricación de puerta de cierta madera. Solicito ayuda con fabricación de puerta de cierta madera. Solicito ayuda con fabricación de puerta de cierta madera'
        ]);

        Job::create([
            'user_id' => 3,
            'jobs_status_id' => 1,
            'providers_service_id' => 1,
            'short_description' => 'Construcción de barda',
            'detailed_description' => 'Solicito experto en construcción de barda de bloque'
        ]);

        Job::create([
            'user_id' => 3,
            'jobs_status_id' => 3,
            'providers_service_id' => 3,
            'short_description' => 'Construcción de casita para mascota',
            'detailed_description' => 'Solicito ayuda con construcción para casa de mascota grande'
        ]);
    
    }
}
