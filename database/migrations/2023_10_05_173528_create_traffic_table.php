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
        Schema::create('traffic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('ukm_id')->nullable();
            $table->unsignedBigInteger('view')->nullable();
            $table->unsignedBigInteger('share')->nullable();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('post')->onDelete('set null');
            $table->foreign('ukm_id')->references('id')->on('ukm')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffic');
    }
};
