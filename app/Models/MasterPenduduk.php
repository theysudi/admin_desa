<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterPenduduk extends Model
{
  public $timestamps = false;
  protected $table = 'm_penduduk';
  protected $fillable = [
    'id',
    'kecamatan',
    'no_kk',
    'nik',
    'nama_lgkp',
    'tmpt_lhr',
    'tgl_lhr',
    'jenis_klmin',
    'status_kawin',
    'golongan_darah',
    'hub_keluarga',
    'agama',
    'pendidikan',
    'pekerjaan',
    'nama_lgkp_ibu',
    'nama_lgkp_ayah',
    'alamat',
    'updated_at',
    'created_at'
  ];

  public function pengajuan(): HasMany
  {
    return $this->hasMany(Pengajuan::class, 'penduduk_id', 'id');
  }
}
