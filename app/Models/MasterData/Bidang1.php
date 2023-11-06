<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class Bidang1 extends Model
{
	public $timestamps = false;
	protected $table = 'm_bidang_1';
	protected $fillable = [
		'kd_bidang_1', 'nm_bidang_1'
	];

	public function bidang2()
	{
		return $this->hasMany(Bidang2::class);
	}
}
