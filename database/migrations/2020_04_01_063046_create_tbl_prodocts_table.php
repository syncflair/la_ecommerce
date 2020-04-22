<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProdoctsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->integer('category_id');
            $table->integer('brand_id');

            $table->string('pro_name');
            $table->longText('pro_desc')->nullable();
            $table->string('pro_color')->nullable();
            $table->string('pro_size')->nullable();
            $table->decimal('pro_price', 8, 2)->nullable();
            $table->string('pro_image')->nullable();
            $table->tinyInteger('pub_status')->default('0');
            $table->timestamps();

           // $table->integer('votes');
            //$table->foreignId('brand_id'); //need research
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_products');
    }
}
