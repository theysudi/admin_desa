<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class Rek1 extends Model
{
	public $timestamps = false;
	protected $table = 'm_rek_1';
	protected $fillable = [
		'kd_rek_1', 'nm_rek_1'
	];

	public function rek2()
	{
		return $this->hasMany(rek2::class);
	}
}
