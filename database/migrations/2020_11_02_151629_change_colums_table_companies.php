<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumsTableCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_companies', function (Blueprint $table) {
            $table->renameColumn('name', 'name_jp');
            $table->string('name_vn');
            $table->string('category_enum')->comment('Companies Category');
            $table->timestamp('established_at')->nullable()->comment('Established Date');
            $table->string('scale_enum')->nullable()->comment('Companies Scale ');
            $table->string('fonds_enum')->nullable()->comment('Companies Fonds');
            $table->decimal('revenue', 12, 2)->nullable()->comment('Revenue');
            $table->decimal('unit_price', 12, 2)->nullable()->comment('Univalence');
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
            $table->renameColumn('name_jp', 'name');
            $table->dropColumn('name_vn');
            $table->dropColumn('category_enum');
            $table->dropColumn('established_at');
            $table->dropColumn('scale_enum');
            $table->dropColumn('fonds_enum');
            $table->dropColumn('revenue');
            $table->dropColumn('unit_price');
        });
    }
}
