<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tribes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();

            $table->integer('attack_magic')->default(0);
            $table->integer('attack_range')->default(0);
            $table->integer('attack_melee')->default(0);

            $table->integer('def_magic')->default(0);
            $table->integer('def_range')->default(0);
            $table->integer('def_melee')->default(0);

            $table->string('head')->nullable();
            $table->string('body')->nullable();
            $table->string('legs')->nullable();
            $table->string('hands')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tribes');
    }
};
