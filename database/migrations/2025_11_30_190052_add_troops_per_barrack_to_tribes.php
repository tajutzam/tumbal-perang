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
        Schema::table('tribes', function (Blueprint $table) {
            $table->integer('troops_per_barrack')->default(5); 
        });
    }

    public function down()
    {
        Schema::table('tribes', function (Blueprint $table) {
            $table->dropColumn('troops_per_barrack');
        });
    }

};
