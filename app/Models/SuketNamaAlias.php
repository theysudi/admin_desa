<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketNamaAlias extends Model
{
  protected $table = 'm_suket_nama_sama_alias';
  protected $fillable = [
    'id',
    'nama',
    'tempat_lahir',
    'tgl_lahir',
    'jenis_kelamin',
    'agama',
    'alamat',
    'nama_lain',
    'tempat_lahir_lain',
    'tgl_lahir_lain',
    'jenis_kelamin_lain',
    'agama_lain',
    'alamat_lain',
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
