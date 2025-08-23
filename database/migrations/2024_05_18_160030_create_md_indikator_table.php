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
        Schema::create('md_indikator', function (Blueprint $table) {
            $table->id();
            $table->string('indikator')->nullable(false);
            $table->foreignId('sasaran_id')->constrained('md_sasaran')->onDelete('cascade');
            $table->foreignId('bidang_id')->nullable()->constrained('bidang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md_indikator');
    }
};
