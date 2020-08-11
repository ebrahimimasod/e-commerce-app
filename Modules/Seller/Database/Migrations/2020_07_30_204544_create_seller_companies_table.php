<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Modules\Seller\Entities\SellerCompany;

class CreateSellerCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->enum('type', collect(SellerCompany::COMPANY_TYPES)->map(function ($type){
                return $type['value'];
            })->toArray())->default(SellerCompany::PUBLIC_STOCK['value']);
            $table->string('registration_number', 50);
            $table->string('national_id', 50);
            $table->string('economic_code', 50);
            $table->string('signature_owners', 255);
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
        Schema::dropIfExists('seller_companies');
    }
}
