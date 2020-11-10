<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyCompanyIdTCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_customers', function (Blueprint $table) {
            $table->bigInteger('company_id')->unsigned()->change();
            $table->foreign('company_id')->references('id')->on('t_companies');
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
            $table->dropForeign('t_customers_company_id_foreign');
        });

    }
}
