<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
	public $incrementing = false;
	protected $primaryKey = 'id';
	protected $table = 'access_token';
	protected $fillable = [
		'id',
		'fcm_token',
		'aplikasi_id',
		'user_id',
		'revoked',
		'expired_at',
		'device',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
