<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'bidang_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke tabel bidang
     */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, "bidang_id", "id");
    }

    /**
     * Relasi ke data_iku berdasarkan user yang mengunggah data
     */
    public function data_iku(): HasMany
    {
        return $this->hasMany(DataIku::class, 'upload_by', 'id');
    }

    /**
     * Relasi ke data_iku berdasarkan user yang menyetujui (approve) di tingkat Binagram
     */
    public function approved_by_binagram(): HasMany
    {
        return $this->hasMany(DataIku::class, 'approve_by_binagram', 'id');
    }

    /**
     * Relasi ke data_iku berdasarkan user yang menolak (reject) di tingkat Admin Approval
     */
    public function rejected_by_approval(): HasMany
    {
        return $this->hasMany(DataIku::class, 'reject_by_approval', 'id');
    }

    /**
     * Relasi ke data_iku berdasarkan user yang menolak (reject) di tingkat Binagram
     */
    public function rejected_by_binagram(): HasMany
    {
        return $this->hasMany(DataIku::class, 'reject_by_binagram', 'id');
    }
}
