<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('estoque')->default(1);
            $table->unsignedDecimal('price', 4, 2)->default(0);
            $table->unsignedBigInteger('tipe_ref');
            $table->unsignedBigInteger('genre_ref');
            $table->unsignedBigInteger('img_ref')->nullable();

            $table->foreign('tipe_ref')->references('id')->on('tb_tipes');
            $table->foreign('genre_ref')->references('id')->on('tb_genres');
            $table->foreign('img_ref')->references('id')->on('tb_imgs');
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
        Schema::dropIfExists('tb_products');
    }
}
