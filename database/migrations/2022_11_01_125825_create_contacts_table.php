<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->text('facebook_link')->nullable();
            $table->text('viber')->nullable();
            $table->text('telegram')->nullable();
            $table->text('agent_number')->nullable();
            $table->text('image')->nullable();
            $table->text('additional_phone_numbers')->nullable();
            $table->text('additional_viber_phone_numbers')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
