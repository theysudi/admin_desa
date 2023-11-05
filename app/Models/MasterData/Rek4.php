<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class Rek4 extends Model
{
	public $timestamps = false;
	protected $table = 'm_rek_4';
	protected $fillable = [
		'kd_rek_1', 'kd_rek_2', 'kd_rek_3', 'kd_rek_4', 'nm_rek_4'
	];

	public function rek3()
	{
		return $this->belongsTo(rek3::class, 'kd_rek_3', 'kd_rek_3');
	}
}
