<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrasiAhli extends Model
{
    public $timestamps = false;
    protected $table = 'tx_registrasi_ahli';
    protected $fillable = [
        'id_registrasi',
        'id_ahli'
    ];

    public function registrasi(): BelongsTo{
        return $this->belongsTo(Registrasi::class, 'id_registrasi', 'id_registrasi');
    }
    public function ahli(): BelongsTo{
        return $this->belongsTo(Ahli::class, 'id_ahli', 'id_ahli');
    }
}
