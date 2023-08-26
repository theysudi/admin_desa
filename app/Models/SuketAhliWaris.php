<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketAhliWaris extends Model
{
  protected $table = 'm_suket_ahli_waris';
  protected $fillable = [
    'id',
    'nama',
    'nik',
    'tempat_lahir',
    'tgl_lahir',
    'pekerjaan',
    'alamat',
    'nomor_surat',
    'deskripsi_1',
    'deskripsi_2',
    'penduduk_id',
    'pengajuan_id',
    'tempat_surat',
    'tgl_surat',
    'created_at',
    'updated_at'
  ];

  public function pengajuan(): HasOne
  {
    return $this->hasOne(Pengajuan::class, 'pengajuan_id', 'id');
  }
}
