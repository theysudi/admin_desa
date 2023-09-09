<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
	protected $primaryKey = null;
	public $incrementing = false;
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
}
