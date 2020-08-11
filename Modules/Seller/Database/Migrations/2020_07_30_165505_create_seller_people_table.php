<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Modules\Seller\Entities\SellerPerson;

class CreateSellerPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name',50)->nullable();
            $table->string('family_name',50)->nullable();
            $table->enum('gender', SellerPerson::GENDER)->nullable();
            $table->string('birthday',20)->nullable();
            $table->string('national_code',15)->nullable();
            $table->string('national_number',15)->nullable();
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
        Schema::dropIfExists('seller_people');
    }
}
