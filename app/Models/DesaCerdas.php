<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesaCerdas extends Model
{

  protected $table = 'm_desa_cerdas';
  protected $fillable = [
    'id',
    'nama',
    'keterangan',
    'file',
    'jenis',
    'created_at',
    'updated_at'
  ];
}
