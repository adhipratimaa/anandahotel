<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('roomtype_id')->nullable();
            $table->unsignedInteger('room_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->date('checkIn_date')->nullable();
            $table->time('checkIn_time')->nullable();
            $table->date('checkOut_date')->nullable();
            $table->time('checkOut_time')->nullable();
            $table->integer('person')->nullable();
            $table->integer('child')->nullable();
            
            $table->double('price', 15,2)->nullable();
            
            $table->string('join')->nullable();
            
            $table->enum('payment_method', ['cash', 'credit', 'card'])->default('cash');
            $table->enum('status', ['Reserved', 'Checked In', 'Canceled', 'Paid', 'Paid & Checked Out'])->default('Checked In');
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
        Schema::dropIfExists('bookings');
    }
}
