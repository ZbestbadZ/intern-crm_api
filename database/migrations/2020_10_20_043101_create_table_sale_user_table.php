<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSaleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('expired_at')->nullable()->comment('"Expiration User"');
            $table->tinyInteger('is_active')->default(0)->comment('"0: inactive, 1: active"');
            $table->tinyInteger('role_id')->default()->comment('"1: Admin, 2: Moderator, 3: Member, 4: Guest"');
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
        Schema::dropIfExists('sale_user');
    }
}
