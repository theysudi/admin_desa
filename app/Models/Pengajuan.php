<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
  protected $table = 'm_pengajuan';
  protected $fillable = [
    'id',
    'penduduk_id',
    'jenis_surat_id',
    'status',
    'penduduk_id_atas_nama',
    'tujuan_permohonan',
    'created_at'
  ];

  public function penduduk(): BelongsTo
  {
    return $this->belongsTo(MasterPenduduk::class, 'penduduk_id', 'id');
  }
  public function jenis_surat(): BelongsTo
  {
    return $this->belongsTo(JenisDokumen::class, 'jenis_surat_id', 'id');
  }
  public function atasnama(): BelongsTo
  {
    return $this->belongsTo(MasterPenduduk::class, 'penduduk_id_atas_nama', 'id');
  }
  public function suketbelumkawin(): BelongsTo
  {
    return $this->belongsTo(SuketBelumKawin::class, 'pengajuan_id', 'id');
  }
  public function suketahliwaris(): BelongsTo
  {
    return $this->belongsTo(SuketAhliWaris::class, 'pengajuan_id', 'id');
  }
  public function suketdomisilianaksekolah(): BelongsTo
  {
    return $this->belongsTo(SuketDomisiliAnakSekolah::class, 'pengajuan_id', 'id');
  }
  public function suketdomisilipura(): BelongsTo
  {
    return $this->belongsTo(SuketDomisiliPura::class, 'pengajuan_id', 'id');
  }
  public function suketdtks(): BelongsTo
  {
    return $this->belongsTo(SuketDtks::class, 'pengajuan_id', 'id');
  }
  public function sukejandaduda(): BelongsTo
  {
    return $this->belongsTo(SuketJandaDuda::class, 'pengajuan_id', 'id');
  }
  public function suketkelahiran(): BelongsTo
  {
    return $this->belongsTo(SuketKelahiran::class, 'pengajuan_id', 'id');
  }
  public function suketletaktanah(): BelongsTo
  {
    return $this->belongsTo(SuketLetakTanah::class, 'pengajuan_id', 'id');
  }
  public function suketmenempatitanah(): BelongsTo
  {
    return $this->belongsTo(SuketMenempatiTanah::class, 'pengajuan_id', 'id');
  }
  public function suketmenikah(): BelongsTo
  {
    return $this->belongsTo(SuketMenikah::class, 'pengajuan_id', 'id');
  }
  public function suketmeninggal(): BelongsTo
  {
    return $this->belongsTo(SuketMeninggal::class, 'pengajuan_id', 'id');
  }
  public function suketnamaalias(): BelongsTo
  {
    return $this->belongsTo(SuketNamaAlias::class, 'pengajuan_id', 'id');
  }
  public function suketpindahdomisili(): BelongsTo
  {
    return $this->belongsTo(SuketPindahDomisili::class, 'pengajuan_id', 'id');
  }
  public function suketsudahmampu(): BelongsTo
  {
    return $this->belongsTo(SuketSudahMampu::class, 'pengajuan_id', 'id');
  }
  public function sukettempatusaha(): BelongsTo
  {
    return $this->belongsTo(SuketTempatUsaha::class, 'pengajuan_id', 'id');
  }
  public function suketdatatercecer(): BelongsTo
  {
    return $this->belongsTo(SuketDataTercecer::class, 'pengajuan_id', 'id');
  }
  public function sukettidakmampu(): BelongsTo
  {
    return $this->belongsTo(SuketTidakMampu::class, 'pengajuan_id', 'id');
  }
  public function sukettidakmemilikitempattinggal(): BelongsTo
  {
    return $this->belongsTo(SuketTidakMampu::class, 'pengajuan_id', 'id');
  }
  public function sukettidakmemiliketurunan(): BelongsTo
  {
    return $this->belongsTo(SuketTidakMemilikiKeturunan::class, 'pengajuan_id', 'id');
  }
}
