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
         Schema::create('current_data_type_'.$index, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_line_id');
            $table->foreign('product_line_id')->references('id')->on('product_lines')->onDelete('cascade');
            $table->string('current_description');
            $table->string('current_image_id');
            $table->string('current_pdf_id');
            $table->string('current_youtube_url');
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
