<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tujuan extends Model
{
    protected $table = 'md_tujuan';
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        "tujuan"
    ];

    public function sasaran(): HasMany
    {
        return $this->hasMany(Sasaran::class, 'tujuan_id', 'id');
    }
}
