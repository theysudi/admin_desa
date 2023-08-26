<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'nama_sistem',
        'nama_institusi',
        'logo_sistem',
        'logo_sistem_minimal',
        'alamat_institusi',
        'telp_institusi',
        'email_institusi',
        'link_ttd_ba',
        'nama_ttd_ba',
        'is_bebaskan_rekapitulasi',
    ];
}
