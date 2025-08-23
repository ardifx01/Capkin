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
        Schema::create('md_sub_indikator', function (Blueprint $table) {
            $table->id();
            $table->string('sub_indikator')->nullable(false);
            $table->foreignId('indikator_penunjang_id')->nullable()->constrained('md_indikator_penunjang')->onDelete('cascade');
            $table->foreignId('indikator_id')->nullable()->constrained('md_indikator')->onDelete('cascade');
            $table->foreignId('bidang_id')->nullable()->constrained('bidang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md_sub_indikator');
    }
};
