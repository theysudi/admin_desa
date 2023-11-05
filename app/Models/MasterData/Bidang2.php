<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class Bidang2 extends Model
{
	public $timestamps = false;
	protected $table = 'm_bidang_2';
	protected $fillable = [
		'kd_bidang_1', 'kd_bidang_2', 'nm_bidang_2'
	];

	public function bidang3()
	{
		return $this->hasMany(Bidang3::class);
	}

	public function bidang1()
	{
		return $this->belongsTo(Bidang1::class, 'kd_bidang_1', 'kd_bidang_1');
	}
}
