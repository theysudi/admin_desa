<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketKelahiran extends Model
{
  protected $table = 'm_suket_kelahiran';
  protected $fillable = [
    'id',
    'nama',
    'tempat_lahir',
    'tgl_lahir',
    'jenis_kelamin',
    'agama',
    'status_perkawinan',
    'pekerjaan',
    'alamat',
    'nomor_surat',
    'tanggal_surat',
    'deskripsi',
    'pengajuan_id',
    'penduduk_id',
    'created_at',
    'updated_at'
  ];

  public function pengajuan(): HasOne
  {
    return $this->hasOne(Pengajuan::class, 'pengajuan_id', 'id');
  }
}
