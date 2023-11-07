<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class SumberDana extends Model
{
	protected $table = 'm_sumber_dana';
	protected $fillable = [
		'nama',
		'is_aktif',
	];
}
