<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubIndikator extends Model
{
    protected $table = 'md_sub_indikator';
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "sub_indikator",
        "indikator_penunjang_id",
        "indikator_id",
        "bidang_id"
    ];

    public function indikator_penunjang(): BelongsTo
    {
        return $this->belongsTo(IndikatorPenunjang::class, 'indikator_penunjang_id', 'id');
    }

    public function indikator(): BelongsTo
    {
        return $this->belongsTo(Indikator::class, 'indikator_id', 'id');
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }

    public function data_iku()
    {
        return $this->hasMany(DataIku::class, 'sub_indikator_id');
    }
}
