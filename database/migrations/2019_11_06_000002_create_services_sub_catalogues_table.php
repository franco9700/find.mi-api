<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesSubCataloguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_sub_catalogues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_catalogue_id');
            $table->foreign('service_catalogue_id')->references('id')->on('services_catalogues')->onDelete('cascade');
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_sub_catalogues');
    }
}
