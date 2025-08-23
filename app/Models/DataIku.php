<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataIku extends Model
{
    use HasFactory;

    protected $table = 'data_iku';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "perjanjian_kinerja_target_kumulatif",
        "perjanjian_kinerja_realisasi_kumulatif",
        "capaian_kinerja_kumulatif",
        "capaian_kinerja_target_setahun",
        "link_bukti_dukung_capaian",
        "upaya_yang_dilakukan",
        "link_bukti_dukung_upaya_yang_dilakukan",
        "kendala",
        "solusi_atas_kendala",
        "rencana_tidak_lanjut",
        "pic_tidak_lanjut",
        "tenggat_tidak_lanjut",
        "status",
        "upload_by",
        "approve_by_binagram",
        "reject_by_approval",
        "reject_by_binagram",
        "triwulan_id",
        "entity_id",
        "indikator_id",
        "indikator_penunjang_id",
        "sub_indikator_id",
        "sasaran_id",
        "tujuan_id",
        "reject_comment"
    ];

    // Definisi status
    public const STATUS_PENDING_APPROVAL = 'pending_approval';
    public const STATUS_PENDING_BINAGRAM = 'pending_binagram';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED_APPROVAL = 'rejected_approval';
    public const STATUS_REJECTED_BINAGRAM = 'rejected_binagram';

    // Relasi ke user yang mengunggah
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'upload_by');
    }

    // Relasi persetujuan
    public function approved_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approve_by_binagram');
    }

    // Relasi penolakan
    public function reject_by_approval(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reject_by_approval');
    }

    public function reject_by_binagram(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reject_by_binagram');
    }

    // Relasi ke indikator dan tujuan
    public function indikator(): BelongsTo
    {
        return $this->belongsTo(Indikator::class, 'indikator_id');
    }

    public function indikator_penunjang(): BelongsTo
    {
        return $this->belongsTo(IndikatorPenunjang::class, 'indikator_penunjang_id');
    }

    public function sub_indikator(): BelongsTo
    {
        return $this->belongsTo(SubIndikator::class, 'sub_indikator_id');
    }

    public function sasaran(): BelongsTo
    {
        return $this->belongsTo(Sasaran::class, 'sasaran_id');
    }

    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id');
    }

    public function triwulan(): BelongsTo
    {
        return $this->belongsTo(Triwulan::class, 'triwulan_id');
    }
}
