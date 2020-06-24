<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersAddAddressReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function(Blueprint $table) {
        $table->unsignedBigInteger('address_id');

        $table->foreign('address_id')->references('id')->on('addresses')->onDelete('CASCADE')->onUpdate('CASCADE');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function(Blueprint $table) {
        $table->dropForeign(['address_id']);
        $table->dropColumn('cep_id');
      });
    }
}
