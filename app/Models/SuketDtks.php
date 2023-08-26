<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketDtks extends Model
{
  protected $table = 'm_suket_dtks';
  protected $fillable = [
    'id',
    'nama_anak',
    'nik',
    'no_kk',
    'id_dtks',
    'alamat',
    'nomor_surat',
    'tanggal_surat',
    'deskripsi',
    'pengajuan_id',
    'created_at',
    'updated_at'
  ];

  public function pengajuan(): HasOne
  {
    return $this->hasOne(Pengajuan::class, 'pengajuan_id', 'id');
  }
}
