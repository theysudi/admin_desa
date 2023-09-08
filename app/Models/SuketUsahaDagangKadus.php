<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketUsahaDagangKadus extends Model
{
  protected $table = 'm_suket_usaha_dagang_kadus';
  protected $fillable = [
    'id',
    'nama_kadus',
    'jabatan_kadus',
    'alamat_kadus',
    'nama',
    'tempat_lahir',
    'tgl_lahir',
    'jenis_kelamin',
    'agama',
    'pekerjaan',
    'status_kawin',
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
