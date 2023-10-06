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
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('event_id');
            $table->string('qris_invoiceid')->unique()->nullable();
            $table->string('qris_content')->unique()->nullable();
            $table->integer('status')->comment('1:paid, 2:unpaid')->default(2);
            $table->unsignedBigInteger('price')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
