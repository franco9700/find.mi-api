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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('jobs_status_id');
            $table->foreign('jobs_status_id')->references('id')->on('jobs_statuses')->onDelete('cascade');
            $table->unsignedBigInteger('providers_service_id');
            $table->foreign('providers_service_id')->references('id')->on('providers_services')->onDelete('cascade');
            $table->string('short_description');
            $table->text('detailed_description');
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
