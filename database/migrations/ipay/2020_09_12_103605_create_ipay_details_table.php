<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipay_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('sale_txn_request')->nullable();
            $table->text('sale_txn_response')->nullable();
            $table->text('sale_txn_verify_request')->nullable();
            $table->text('sale_txn_verify_response')->nullable();
            $table->string('final_status')->nullable();
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
        Schema::dropIfExists('ipay_details');
    }
}
