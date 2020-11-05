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
            $table->enum('category',[1, 2, 3, 4, 5, 6]);
            $table->timestamp('established_at')->nullable()->comment('Established Date');
            $table->enum('scale', [
                '1-10',
                '10-50',
                '50-100',
                '100-500',
                '500-1000',
                '> 1000',
            ]);
            $table->enum('fonds', [
                '1- 1000万円',
                '1000-5000万円',
                '5000~1億円',
                '1億円 ~',
            ]);
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
            $table->dropColumn('category');
            $table->dropColumn('established_at');
            $table->dropColumn('scale');
            $table->dropColumn('fonds');
            $table->dropColumn('revenue');
            $table->dropColumn('unit_price');
        });
    }
}
