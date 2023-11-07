<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
	protected $table = 'tx_keuangan';
	protected $fillable = [
		'tahun',
		'sumber_dana_id',
		'sumber_dana',
		'kd_bidang_1',
		'kd_bidang_2',
		'kd_bidang_3',
		'nm_bidang_3',
		'kd_rek_1',
		'nm_rek_1',
		'kd_rek_2',
		'kd_rek_3',
		'kd_rek_4',
		'nm_rek_4',
		'anggaran',
		'realisasi'
	];
}
