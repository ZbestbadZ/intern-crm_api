<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_customers', function (Blueprint $table) {
            
            $table->renameColumn('name','name_kanji');
            $table->string('name_romanji')->after('name')->nullable();
            $table->bigInteger('company_id')->after('id');
            $table->integer('position_id')->unsigned()->nullable()->after('company_id');
            $table->date('birthday')->after('email')->nullable();
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
            $table->dropColumn('name_romanji');
            $table->dropColumn('company_id');
            $table->dropColumn('birthday');
            $table->dropColumn('position_id');
            $table->renameColumn('name_kanji','name');
        });

    }
}
