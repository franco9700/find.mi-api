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
            'rfc' => 'asdajsd31',
            'provider_banner' => null,
            'quotation' => 125.25,
            'description' => '10 years of experience'
        ]);

        UsersProvider::create([
            'user_id' => 2,
            'rfc' => 'me gusta la caca 123',
            'provider_banner' => null,
            'quotation' => null,
            'description' => '20 years of experience'
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
            'short_description' => 'Me exploto el culo, ayuda',
            'detailed_description' => 'Estaba ahi en el cague, y de repente exploto. Sin comentarios, 0/10'
        ]);

        Job::create([
            'user_id' => 2,
            'jobs_status_id' => 2,
            'providers_service_id' => 2,
            'short_description' => 'Me exploto el culo otra vez, ayuda',
            'detailed_description' => 'Esta vez estaba en la cocina y de repente exploto. Increible.'
        ]);

        Job::create([
            'user_id' => 3,
            'jobs_status_id' => 1,
            'providers_service_id' => 1,
            'short_description' => 'Necesito ayuda con mi madre',
            'detailed_description' => 'No hace lo que quiero y me frustra'
        ]);

        Job::create([
            'user_id' => 3,
            'jobs_status_id' => 1,
            'providers_service_id' => 3,
            'short_description' => 'Necesito ayuda',
            'detailed_description' => 'porfa'
        ]);
    
    }
}
