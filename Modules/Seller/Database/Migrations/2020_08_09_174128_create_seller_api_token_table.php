<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellerApiTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_api_token', function (Blueprint $table) {
            $table->id('id');
            $table->text('api_token')->collation('utf8_bin');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->on('sellers')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('expire_at');
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
        Schema::dropIfExists('seller_api_token');
    }
}
