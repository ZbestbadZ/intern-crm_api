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
            $table->string('fax')->nullable()->change();
            $table->string('website')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('map_link')->nullable()->change();
            $table->string('customs')->nullable()->change();
            $table->string('description')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
