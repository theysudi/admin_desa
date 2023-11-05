<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class Rek2 extends Model
{
	public $timestamps = false;
	protected $table = 'm_rek_2';
	protected $fillable = [
		'kd_rek_1', 'kd_rek_2', 'nm_rek_2'
	];

	public function rek3()
	{
		return $this->hasMany(rek3::class);
	}

	public function rek1()
	{
		return $this->belongsTo(rek1::class, 'kd_rek_1', 'kd_rek_1');
	}
}
