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
    Schema::table('battle_logs', function (Blueprint $table) {
        $table->integer('attack_power')->default(0);
        $table->integer('defense_power')->default(0);
        $table->integer('building_bonus')->default(0);
        $table->integer('attacker_losses')->default(0);
        $table->integer('defender_losses')->default(0);
    });
}

public function down()
{
    Schema::table('battle_logs', function (Blueprint $table) {
        $table->dropColumn([
            'attack_power',
            'defense_power',
            'building_bonus',
            'attacker_losses',
            'defender_losses'
        ]);
    });
}

};
