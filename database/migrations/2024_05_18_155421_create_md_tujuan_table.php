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
        Schema::create('md_tujuan', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan')->nullable(false);
            $table->tinyInteger('iku')->default("0")->comment('0:iku,1:iku suplemen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('md_tujuan');
    }
};
