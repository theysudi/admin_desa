<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LayananKesehatan extends Model
{

  protected $table = 'm_posyandu';
  protected $fillable = [
    'id',
    'hari',
    'tanggal',
    'kegiatan',
    'uraian',
    'waktu',
    'tempat',
    'keterangan',
    'created_at',
    'updated_at'
  ];
}
