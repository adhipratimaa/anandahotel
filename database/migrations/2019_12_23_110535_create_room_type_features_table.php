<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTypeFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_type_features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roomtype_id')->unsigned();
            $table->foreign('roomtype_id')->references('id')->on('room_types')->onDelete('cascade');
            $table->unsignedBigInteger('feature_id')->unsigned();
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
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
        Schema::dropIfExists('room_type_features');
    }
}
