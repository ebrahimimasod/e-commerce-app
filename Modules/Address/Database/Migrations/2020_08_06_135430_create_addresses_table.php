<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('id');
            $table->text('address');
            $table->string('plaque');
            $table->string('unit');
            $table->string('post_code');
            $table->string('lon');
            $table->string('lat');
            $table->string('user_name');
            $table->string('user_mobile');
            $table->boolean('is_selected');
            $table->unsignedBigInteger('use_in_order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('province_id');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('province_id')->on('provinces')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('addresses');
    }
}
