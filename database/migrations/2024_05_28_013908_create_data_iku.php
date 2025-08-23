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
        Schema::create('data_iku', function (Blueprint $table) {
            $table->id();
            $table->integer('perjanjian_kinerja_target_kumulatif')->default(0)->nullable(false);
            $table->integer('perjanjian_kinerja_realisasi_kumulatif')->default(0)->nullable();
            $table->float('capaian_kinerja_kumulatif')->default(0.0)->nullable();
            $table->float('capaian_kinerja_target_setahun')->default(0.0)->nullable();
            $table->string('link_bukti_dukung_capaian')->nullable();
            $table->text('upaya_yang_dilakukan')->nullable();
            $table->string('link_bukti_dukung_upaya_yang_dilakukan')->nullable();
            $table->text('kendala')->nullable();
            $table->text('solusi_atas_kendala')->nullable();
            $table->text('rencana_tidak_lanjut')->nullable();
            $table->string('pic_tidak_lanjut')->nullable();
            $table->date('tenggat_tidak_lanjut')->nullable();
            $table->timestamps();

            //Status yang sudah diperbaiki
            $table->enum('status', [
                'pending_approval',   // Menunggu persetujuan Admin Approval
                'pending_binagram',   // Sudah disetujui Admin Approval, menunggu Binagram
                'approved',           // Sudah disetujui oleh Binagram (Final Approved)
                'rejected_approval',  // Ditolak oleh Admin Approval
                'rejected_binagram'   // Ditolak oleh Binagram
            ])->default('pending_approval');

            //Relasi ke user yang mengupload
            $table->foreignId('upload_by')->constrained('users')->onDelete('cascade');

            //Relasi untuk Approval & Rejection per level
            $table->foreignId('approve_by_binagram')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('reject_by_approval')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('reject_by_binagram')->nullable()->constrained('users')->onDelete('cascade');

            //Relasi ke triwulan
            $table->foreignId('triwulan_id')->nullable(false)->constrained('triwulan')->onDelete('cascade');

            //Alasan Reject
            $table->text('reject_comment')->nullable();

            //Relasi ke indikator & tujuan
            $table->foreignId('indikator_id')->nullable()->constrained('md_indikator')->onDelete('cascade');
            $table->foreignId('indikator_penunjang_id')->nullable()->constrained('md_indikator_penunjang')->onDelete('cascade');
            $table->foreignId('sub_indikator_id')->nullable()->constrained('md_sub_indikator')->onDelete('cascade');
            $table->foreignId('sasaran_id')->nullable()->constrained('md_sasaran')->onDelete('cascade');
            $table->foreignId('tujuan_id')->nullable()->constrained('md_tujuan')->onDelete('cascade');
            $table->foreignId('bidang_id')->nullable()->constrained('bidang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_iku');
    }
};
