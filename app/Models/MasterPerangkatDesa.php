<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterPerangkatDesa extends Model
{

  protected $table = 'm_perangkat_desa';
  protected $fillable = [
    'id',
    'penduduk_id',
    'nama',
    'no_hp',
    'jenis',
    'jabatan',
    'created_at',
    'updated_at'
  ];

  public function penduduk(): BelongsTo
  {
    return $this->belongsTo(MasterPenduduk::class, 'penduduk_id', 'id');
  }
}
