<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sasaran extends Model
{
    protected $table = 'md_sasaran';
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "sasaran",
        "tujuan_id"
    ];

    public function tujuan(): BelongsTo
    {
        return $this->belongsTo(Tujuan::class, 'tujuan_id', 'id');
    }

    public function indikator(): HasMany
    {
        return $this->hasMany(Indikator::class, 'sasaran_id', 'id');
    }
}
