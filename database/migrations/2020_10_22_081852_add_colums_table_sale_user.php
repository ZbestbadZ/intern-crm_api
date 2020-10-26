<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsTableSaleUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_user', function (Blueprint $table) {
            $table->string('is_auth')->after('role_id')->default(0)->comment('"0: No Authencation, 1: Authenticated"');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_user', function (Blueprint $table) {
            $table->dropColumn('is_auth');
        });
    }
}
