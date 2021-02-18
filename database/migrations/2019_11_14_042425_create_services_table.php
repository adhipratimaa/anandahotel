<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('title')->nullable();
            $table->enum('category',['packages','dining','meeting_and_conference']);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('show_in_menu')->nullable();
            $table->string('logo')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('services');
    }
}
