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
            $table->string('name_romanji')->after('email')->nullable();
            $table->bigInteger('company_id');
            $table->date('birthday')->nullable();
            $table->integer('position_id')->unsigned();
            $table->text('description',1000)->nullable();
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
            $table->dropColumn('description');
            $table->renameColumn('name_kanji','name');
        });

    }
}
