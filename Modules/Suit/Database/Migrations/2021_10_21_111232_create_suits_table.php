<?php

use Modules\Suit\Entities\Suit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->date('date');
            $table->enum('status', [Suit::PENDING, Suit::FINISHED]);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suits');
    }
}
