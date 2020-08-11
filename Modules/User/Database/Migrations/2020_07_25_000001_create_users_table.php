<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Modules\User\Entities\User;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userLevels = collect(User::LEVELS)->map(function ($item) {
            return $item['value'];
        })->toArray();
        Schema::create('users', function (Blueprint $table) use ($userLevels) {
            $table->bigIncrements('id');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('mobile', 20);
            $table->string('email', 100)->nullable();
            $table->string('password')->nullable();
            $table->enum('level', $userLevels)->default(User::USER_LEVEL['value']);
            $table->timestamp('mobile_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_visit')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('users');
    }
}
