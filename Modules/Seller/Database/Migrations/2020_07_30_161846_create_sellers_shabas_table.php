<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Modules\Seller\Entities\SellersShaba;

class CreateSellersShabasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers_shabas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',30);
            $table->string('owner',50);
            $table->enum('status', SellersShaba::STATUS)->default(SellersShaba::PROCESSING);
            $table->unsignedBigInteger('seller_id');
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
        Schema::dropIfExists('sellers_shabas');
    }
}
