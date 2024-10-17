<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCurrentProductLineAttatchment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('current_product_line_attatchment', function (Blueprint $table) {
            $table->string('instagram');
            $table->string('facebook');
            $table->string('shop');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('current_product_line_attatchment', function (Blueprint $table) {
            //
        });
    }
}
