<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientSuitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_suit', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
                $table->unsignedBigInteger('suit_id');

                $table->foreign('client_id')
                    ->references('id')
                    ->on('clients');

                $table->foreign('suit_id')
                    ->references('id')
                    ->on('suits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_suit');
    }
}
