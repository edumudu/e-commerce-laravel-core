<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
          $table->unsignedBigInteger('product_id');
          $table->unsignedBigInteger('category_id');

          $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
                
          $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
