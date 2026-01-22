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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('gold_per_minute')->default(0);
            $table->integer('troop_per_minute')->default(0);
            $table->integer('defense_bonus')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
