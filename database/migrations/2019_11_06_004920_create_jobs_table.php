<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('job_status_id');
            $table->foreign('job_status_id')->references('id')->on('jobs_statuses')->onDelete('cascade');
            $table->unsignedBigInteger('provider_service_id');
            $table->foreign('provider_service_id')->references('id')->on('providers_services')->onDelete('cascade');
            $table->string('short_description');
            $table->string('detailed_description');
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
        Schema::dropIfExists('jobs');
    }
}
