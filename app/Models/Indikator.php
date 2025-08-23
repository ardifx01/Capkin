<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indikator extends Model
{
    protected $table = 'md_indikator';
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "indikator",
        "sasaran_id"
    ];

    public function sasaran(): BelongsTo
    {
        return $this->belongsTo(Sasaran::class, 'sasaran_id', 'id');
    }

    public function indikator_penunjang(): HasMany
    {
        return $this->hasMany(IndikatorPenunjang::class, 'indikator_id', 'id');
    }

    public function sub_indikator(): HasMany
    {
        return $this->hasMany(SubIndikator::class, 'indikator_id', 'id');
    }

    public function data_iku()
    {
        return $this->hasMany(DataIku::class, 'indikator_id');
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
}
