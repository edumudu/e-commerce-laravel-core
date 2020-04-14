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
            $table->unsignedDecimal('price', 6, 2)->default(0);
            $table->string('img_folder');
            $table->unsignedBigInteger('tipe_ref');
            $table->unsignedBigInteger('genre_ref');

            $table->foreign('tipe_ref')->references('id')->on('tb_tipes')->onDelete('cascade');
            $table->foreign('genre_ref')->references('id')->on('tb_genres')->onDelete('cascade');
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
