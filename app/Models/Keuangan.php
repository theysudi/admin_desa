<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
	protected $table = 'tx_keuangan';
	protected $fillable = [
		'nama',
		'keterangan',
		'file',
		'isaktif',
	];
}
