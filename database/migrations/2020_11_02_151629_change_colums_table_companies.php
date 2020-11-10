<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CategoryType;
use App\Enums\CapitalType;
use App\Enums\ScaleType;

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
            $table->enum('category',[
                    CategoryType::LevelOne,
                    CategoryType::LevelTwo,
                    CategoryType::LevelThree,
                    CategoryType::LevelFour,
                    CategoryType::LevelFive,
                    CategoryType::LevelOfficial,
                ]
            );
            $table->timestamp('established_at')->nullable()->comment('Established Date');
            $table->enum('scale', [
                ScaleType::LevelOne,
                ScaleType::LevelTwo,
                ScaleType::LevelThree,
                ScaleType::LevelFour,
                ScaleType::LevelFive,
                ScaleType::LevelSix,
            ]);
            $table->enum('capital', [
                CapitalType::LevelOne,
                CapitalType::LevelTwo,
                CapitalType::LevelThree,
                CapitalType::LevelFour,
            ]);
            $table->decimal('revenue', 12, 0)->nullable()->comment('Revenue');
            $table->decimal('unit_price', 12, 0)->nullable()->comment('Univalence');
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
            $table->dropColumn('capital');
            $table->dropColumn('revenue');
            $table->dropColumn('unit_price');
        });
    }
}
