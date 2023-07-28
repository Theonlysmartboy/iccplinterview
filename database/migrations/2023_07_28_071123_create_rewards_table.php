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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->integer('c_id');
            $table->integer('t_id');
            $table->foreignId('reward_conversion_ratio_id')->references('id')->on('reward_conversion_ratios')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('points', 10,2)->unsigned();
            $table->foreignId('status_id')->references('id')->on('statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
