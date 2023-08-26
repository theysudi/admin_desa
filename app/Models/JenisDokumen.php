<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisDokumen extends Model
{
  public $timestamps = false;
  protected $table = 'm_jenis_surat';
  protected $fillable = [
    'id',
    'jenis_surat'
  ];

  public function pengajuan(): HasMany
  {
    return $this->hasMany(Pengajuan::class, 'jenis_surat_id', 'id');
  }
}
