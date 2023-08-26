<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketDomisiliPura extends Model
{
  protected $table = 'm_suket_domisili_pura';
  protected $fillable = [
    'id',
    'nama_pengempon',
    'alamat',
    'nomor_surat',
    'tanggal_surat',
    'deskripsi',
    'penduduk_id',
    'pengajuan_id',
    'created_at',
    'updated_at'
  ];

  public function pengajuan(): HasOne
  {
    return $this->hasOne(Pengajuan::class, 'pengajuan_id', 'id');
  }
}
