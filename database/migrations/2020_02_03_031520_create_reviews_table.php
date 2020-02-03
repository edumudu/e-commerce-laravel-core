<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prod_ref');
            $table->unsignedBigInteger('user_ref');
            $table->text('review');
            $table->unsignedDecimal('rating', 3, 2);
            $table->date('writed_at');

            $table->foreign('prod_ref')->references('id')->on('tb_products')->onDelete('cascade');
            $table->foreign('user_ref')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('tb_reviews');
    }
}
