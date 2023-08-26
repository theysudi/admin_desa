<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketTempatUsaha extends Model
{
  protected $table = 'm_suket_tempat_usaha';
  protected $fillable = [
    'id',
    'nama',
    'tempat_lahir',
    'tgl_lahir',
    'jenis_kelamin',
    'agama',
    'pekerjaan',
    'status_kawin',
    'alamat',
    'nama_usaha',
    'jenis_usaha',
    'alamat_usaha',
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
