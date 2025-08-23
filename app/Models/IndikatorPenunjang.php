<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndikatorPenunjang extends Model
{
    protected $table = 'md_indikator_penunjang';
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "indikator_penunjang",
        "indikator_id"
    ];

    public function indikator(): BelongsTo
    {
        return $this->belongsTo(Indikator::class, 'indikator_id', 'id');
    }

    public function sub_indikator(): HasMany
    {
        return $this->hasMany(SubIndikator::class, 'indikator_penunjang_id', 'id');
    }

    public function data_iku()
    {
        return $this->hasMany(DataIku::class, 'indikator_penunjang_id');
    }
}
