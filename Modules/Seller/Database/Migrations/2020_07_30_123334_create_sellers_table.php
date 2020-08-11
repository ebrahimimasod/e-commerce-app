<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Modules\Seller\Entities\Seller;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number', 6);
            $table->string('email', 50);
            $table->string('mobile', 20);
            $table->string('website', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('post_code', 15)->nullable();
            $table->string('telephone', 15)->nullable();
            $table->string('map_latitude', 50)->nullable();
            $table->string('map_longitude', 50)->nullable();
            $table->enum('type', Seller::SELLER_TYPES)->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('password', 200);
            $table->boolean('tax_status')->nullable();
            $table->string('logo', 200)->nullable();
            $table->text('about')->nullable();
            $table->enum('status', Seller::STATUS)->default(Seller::DISABLE_STATUS);
            $table->string('national_card_front_doc', 200)->nullable();
            $table->string('national_card_back_doc', 200)->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
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

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();

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
        Schema::dropIfExists('sellers');
    }
}
