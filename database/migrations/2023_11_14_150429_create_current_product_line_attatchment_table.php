<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentProductLineAttatchmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_product_line_attatchment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_line_id');
            $table->foreign('product_line_id')->references('id')->on('product_lines')->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->string('pdf');
            $table->string('youtube');
            $table->tinyInteger('is_active');
            $table->tinyInteger('product_line_attachment_status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('current_product_line_attatchment');
    }
}
