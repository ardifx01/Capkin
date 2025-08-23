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
        Schema::create('md_indikator_penunjang', function (Blueprint $table) {
            $table->id();
            $table->string('indikator_penunjang')->nullable(false);
            $table->foreignId('indikator_id')->constrained('md_indikator')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md_indikator_penunjang');
    }
};
