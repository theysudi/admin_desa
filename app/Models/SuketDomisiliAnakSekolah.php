<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketDomisiliAnakSekolah extends Model
{
  protected $table = 'm_suket_domisili_anak_sekolah';
  protected $fillable = [
    'id',
    'nama_ortu',
    'tempat_lahir_ortu',
    'tgl_lahir_ortu',
    'jenis_kelamin',
    'agama',
    'pekerjaan',
    'status_perkawinan',
    'alamat_ortu',
    'nama_anak',
    'tempat_lahir_anak',
    'tgl_lahir_anak',
    'alamat_anak',
    'nomor_surat',
    'deskripsi_1',
    'penduduk_id',
    'pengajuan_id',
    'tgl_surat',
    'tempat_surat',
    'created_at',
    'updated_at'
  ];

  public function pengajuan(): HasOne
  {
    return $this->hasOne(Pengajuan::class, 'pengajuan_id', 'id');
  }
}
