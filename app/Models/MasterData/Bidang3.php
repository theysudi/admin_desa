<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class Bidang3 extends Model
{
	public $timestamps = false;
	protected $table = 'm_bidang_3';
	protected $fillable = [
		'kd_bidang_1', 'kd_bidang_2', 'kd_bidang_3', 'nm_bidang_3'
	];

	public function bidang2()
	{
		return $this->belongsTo(Bidang2::class, 'kd_bidang_2', 'kd_bidang_2');
	}
}
