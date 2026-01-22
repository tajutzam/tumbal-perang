<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_rewards', function (Blueprint $table) {
            $table->id();

            // user ID pemilik reward
            $table->unsignedBigInteger('user_id');

            // tanggal terakhir claim reward
            $table->date('last_claim')->nullable();

            $table->timestamps();

            // relasi (opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_rewards');
    }
};
