<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_id');
            $table->string('user_id')->nullable();
            $table->integer('amount')->nullable();
            $table->string('user_account')->nullable();
            $table->string('photo')->nullable();
            $table->integer('status');
            $table->string('total_points')->nullable();
            $table->integer('point_value')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
