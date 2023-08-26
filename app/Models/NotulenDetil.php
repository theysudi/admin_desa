<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotulenDetil extends Model
{
    protected $table = 'tx_registrasi_notulen_detil';
    public $timestamps = false;
    protected $fillable = [
        'id_notulen',
        'id_dokumen',
        'status_kesesuaian',
        'link_dokumen',
        'catatan'
    ];

    public function notulen():BelongsTo{
        return $this->BelongsTo(Notulen::class, 'id_notulen', 'id_notulen');
    }
    public function dokumen():BelongsTo{
        return $this->BelongsTo(Dokumen::class, 'id_dokumen', 'id_dokumen');
    }
}
