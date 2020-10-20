<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmailauthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailauth', function (Blueprint $table) {
            $table->id();
            $table->string('authcode');
            $table->string('email');
            $table->string('password_tmp');
            $table->integer('sale_user_id');
            $table->tinyInteger('authpurpose');
            $table->timestamp('expirationdatetime');
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
        Schema::dropIfExists('emailauth');
    }
}
