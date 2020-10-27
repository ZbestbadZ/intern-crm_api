<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumsTableEmailAuth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_auth', function (Blueprint $table) {
            $table->renameColumn('authcode', 'auth_code');
            $table->renameColumn('authpurpose', 'auth_purpose');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_auth', function(Blueprint $table) {
            $table->renameColumn('auth_code', 'authcode');
            $table->renameColumn('auth_purpose', 'authpurpose');
        });
    }
}
