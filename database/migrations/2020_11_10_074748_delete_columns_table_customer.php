<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnsTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_customers', function (Blueprint $table) {
            $table->dropColumn('fax');
            $table->dropColumn('website');
            $table->dropColumn('address');
            $table->dropColumn('map_link');
            $table->dropColumn('customs');
            $table->dropColumn('description');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_customers', function (Blueprint $table) {
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('map_link')->nullable();
            $table->string('customs')->nullable();
            $table->string('description')->nullable();
        });

    }
}
