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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('purchase_price',8,2);
            $table->decimal('sale_price',8,2);
            $table->integer('discount')->nullable();
            $table->string('model');
            $table->string('image');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->foreignId('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
