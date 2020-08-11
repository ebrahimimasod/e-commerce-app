<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('id')->unsigned();
            $table->unsignedInteger('count')->default(1);
            $table->string('cookie')->nullable();
            $table->bigInteger('price');
            $table->bigInteger('update_price');

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('variant_value_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();

            $table->foreign('product_id')->on('products')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('variant_value_id')->on('variant_values')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('seller_id')->on('sellers')->references('id')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('carts');
    }
}
