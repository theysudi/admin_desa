<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class Rek3 extends Model
{
	public $timestamps = false;
	protected $table = 'm_rek_3';
	protected $fillable = [
		'kd_rek_1', 'kd_rek_2', 'kd_rek_3', 'nm_rek_3'
	];

	public function rek4()
	{
		return $this->hasMany(rek4::class);
	}

	public function rek2()
	{
		return $this->belongsTo(rek2::class, 'kd_rek_2', 'kd_rek_2');
	}
}
