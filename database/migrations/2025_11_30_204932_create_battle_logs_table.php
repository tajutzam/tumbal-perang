<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('battle_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attacker_id');
            $table->unsignedBigInteger('defender_id');
            $table->integer('attacker_troops_before')->default(0);
            $table->integer('defender_troops_before')->default(0);
            $table->bigInteger('gold_transferred')->default(0);
            $table->integer('attacker_troops_after')->default(0);
            $table->integer('defender_troops_after')->default(0);
            $table->boolean('attacker_won')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('attacker_id');
            $table->index('defender_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('battle_logs');
    }
};
