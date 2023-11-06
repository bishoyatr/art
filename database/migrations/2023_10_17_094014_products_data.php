<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        $types = config('types');
        foreach($types as $index => $type)
        {
         Schema::create('data_type_'.$index, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product_lines');
            $table->string('history_album_attachments');
            $table->string('current_pdf_attachment');
            $table->tinyInteger('is_active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         $types = config('types');
        foreach($types as $index => $type)
        {
        Schema::dropIfExists('data_type_'.$index);
        }
    }
}
