<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketBelumKawin extends Model
{
  protected $table = 'm_suket_belum_nikah';
  protected $fillable = [
    'id',
    'nama',
    'jenis_kelamin',
    'tempat_lahir',
    'tgl_lahir',
    'agama',
    'pekerjaan',
    'alamat',
    'nomor_surat',
    'deskripsi_1',
    'deskripsi_2',
    'pengajuan_id',
    'tgl_surat',
    'tempat_surat',
    'penduduk_id'
  ];

  public function pengajuan(): HasOne
  {
    return $this->hasOne(Pengajuan::class, 'pengajuan_id', 'id');
  }
}
