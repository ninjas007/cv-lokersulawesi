<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('company_name')->nullable();
            $table->json('location')->nullable();
            $table->string('slug')->nullable();
            $table->json('job_types')->nullable();
            $table->string('salary')->nullable();
            $table->string('status')->nullable();
            $table->string('publish_on')->nullable();
            $table->text('description')->nullable();
            $table->string('link_url')->nullable();
            $table->timestamp('publish_on_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
