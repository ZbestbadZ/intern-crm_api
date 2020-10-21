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
            $table->string('authcode')->comment('"Code Authencation"');
            $table->string('email');
            $table->string('password_tmp')->comment('"Password Provisional"');
            $table->integer('sale_user_id');
            $table->tinyInteger('authpurpose')->comment('"1: Create new, 2: Forgot Password"');
            $table->timestamp('expiration_at')->nullable()->comment('"Authencation Code Expiration Time"');
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
