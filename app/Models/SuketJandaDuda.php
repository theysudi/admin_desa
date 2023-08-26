<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuketJandaDuda extends Model
{
  protected $table = 'm_suket_duda_janda';
  protected $fillable = [
    'id',
    'nama_hidup',
    'alamat_hidup',
    'nama',
    'pangkat',
    'nip',
    'nomor_pensiun',
    'instansi',
    'tanggal_meninggal',
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
