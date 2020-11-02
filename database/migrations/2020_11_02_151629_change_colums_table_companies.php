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
        Schema::table('m_companies', function (Blueprint $table) {
            $table->renameColumn('name', 'name_jp');
            $table->string('name_vn');
            $table->integer('category_id')->after('address')->comment('ID table Category');
            $table->timestamp('found_at')->after('address')->nullable()->comment('Found Date');
            $table->integer('scale_id')->after('address')->nullable()->comment('ID table scale ');
            $table->integer('charter_capital_id')->after('address')->nullable()->comment('ID table Charter Capital');
            $table->decimal('revenue', 12, 2)->after('address')->nullable()->comment('Revenue');
            $table->decimal('univalence', 12, 2)->after('address')->nullable()->comment('Univalence');
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
            $table->dropColumn('name_jp');
            $table->dropColumn('name_vn');
            $table->dropColumn('category_id');
            $table->dropColumn('found_at');
            $table->dropColumn('scale_id');
            $table->dropColumn('charter_capital_id');
            $table->dropColumn('revenue');
            $table->dropColumn('orbit_tags');
            $table->dropColumn('univalence');
        });
    }
}
