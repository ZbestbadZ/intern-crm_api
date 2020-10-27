<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumsPasswordTmpEmailauth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emailauth', function (Blueprint $table) {
            $table->string('password_tmp')->nullable()->comment('"Password Provisional"')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emailauth', function (Blueprint $table) {
            $table->dropColumn('password_tmp');
        });
    }
}
