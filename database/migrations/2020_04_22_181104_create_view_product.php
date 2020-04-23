<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViewProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
          CREATE VIEW vw_products
          AS
          SELECT
            p.id,
            p.name,
            p.inventory,
            p.price,
            p.img_folder,
            g.genre,
            t.tipe,
            FORMAT(AVG(r.rating), 2) as rating,
            p.created_at,
            p.updated_at,
            p.posted_by
          FROM
            tb_products as p
            LEFT JOIN tb_reviews as r ON p.id = r.prod_ref
            LEFT JOIN tb_genres as g ON p.genre_ref = g.id
            LEFT JOIN tb_tipes as t ON p.tipe_ref = t.id
          GROUP BY p.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW vw_products');
    }
}
