<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuitProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suit_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suit_id');
            $table->unsignedBigInteger('purveyor_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('price', 19, 2);
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('suit_id')
                ->references('id')
                ->on('suits');

            $table->foreign('purveyor_id')
                ->references('id')
                ->on('purveyors');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suit_products');
    }
}
