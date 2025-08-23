<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bidang extends Model
{
    protected $table = "bidang";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        "nama_bidang"
    ];


    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'bidang_id', 'id');
    }

    public function bidang(): HasMany
    {
        return $this->hasMany(SubIndikator::class, 'bidang_id', 'id');
    }

    public function sub_indikator(): HasMany
    {
        return $this->hasMany(SubIndikator::class, 'bidang_id', 'id');
    }
}
