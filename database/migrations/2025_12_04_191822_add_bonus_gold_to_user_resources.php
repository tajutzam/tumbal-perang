<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_resources', function (Blueprint $table) {
            $table->integer('bonus_gold')->default(0)->after('gold');
        });
    }

    public function down()
    {
        Schema::table('user_resources', function (Blueprint $table) {
            $table->dropColumn('bonus_gold');
        });
    }

};
