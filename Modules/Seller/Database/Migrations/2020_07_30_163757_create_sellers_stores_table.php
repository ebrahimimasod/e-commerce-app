<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
class CreateSellersStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->text('address');
            $table->string('post_code',15);
            $table->string('telephone',15);
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('seller_id');

            $table->foreign('province_id')
                ->on('provinces')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreign('city_id')
                ->on('cities')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreign('seller_id')
                ->on('sellers')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('sellers_stores');
    }
}
