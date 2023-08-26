<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registrasi extends Model
{
    protected $table = 'tx_registrasi';
    protected $fillable = [
        'kode_registrasi',
        'id_bangunan_gedung',
        'tgl_awal_penugasan',
        'tgl_akhir_penugasan',
        'status_persetujuan',
        'tgl_registrasi'
    ];

    public function registrasiDokumen(): HasMany
    {
        return $this->hasMany(HasMany::class, 'id_registrasi', 'id_registrasi');
    }
    public function bangunangedung(): HasOne
    {
        return $this->hasOne(BangunanGedung::class, 'id_bangunan_gedung', 'id_bangunan_gedung');
    }
    public function konsultasirpt(): HasMany
    {
        return $this->HasMany(RptKonsultasi::class, 'id_konsultasi', 'id_konsultasi');
    }
    public function plenorpt(): HasMany
    {
        return $this->HasMany(RptPleno::class, 'id_pleno', 'id_pleno');
    }
}
