<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumsTableCompaines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_companies', function (Blueprint $table) {
            $table->dropColumn('map_link');
            $table->dropColumn('media_1');
            $table->dropColumn('media_2');
            $table->dropColumn('media_3');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_companies', function (Blueprint $table) {
            $table->string('map_link')->nullable();
            $table->string('media_1')->nullable();
            $table->string('media_2')->nullable();
            $table->string('media_3')->nullable();
        });

    }
}
