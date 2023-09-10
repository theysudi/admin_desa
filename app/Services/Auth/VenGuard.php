<?php

namespace App\Services\Auth;

use App\Models\AccessToken;
use App\Models\Role;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;

class VenGuard implements Guard
{
	use GuardHelpers;

	protected $request;

	protected $accessToken;

	/**
	 * Create a new venguard.
	 *
	 * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $cookiesName
	 * @return void
	 */

	public function __construct(UserProvider $provider, Request $request)
	{
		$this->request = $request;
		$this->provider = $provider;
	}

	/**
	 * Get the currently authenticated user.
	 *
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function user()
	{
		if (!is_null($this->user)) {
			return $this->user;
		}

		$user = null;

		if (!is_null($this->accessToken())) {
			if (!$this->accessToken->revoked) {
				// if (!$this->accessToken->isExpired()) {
				// 	$this->accessToken->renew();
				// }
				$user = $this->accessToken->user;
			}
		}

		return $this->user = $user;
	}

	/**
	 * Get the access token for the current request.
	 *
	 * @return \App\Models\AccessToken
	 */
	public function accessToken()
	{
		if (!is_null($this->accessToken)) {
			return $this->accessToken;
		}

		$accessToken = null;

		$token = $this->getTokenForRequest();

		if (!empty($token)) {
			$accessToken = AccessToken::where('id', hash('sha256', $token))->first();
		}

		return $this->accessToken = $accessToken;
	}

	/**
	 * Get the token for the current request.
	 *
	 * @return string
	 */
	public function getTokenForRequest()
	{
		$token = $this->request->bearerToken();

		return $token;
	}

	/**
	 * Validate a user's credentials.
	 *
	 * @param  array  $credentials
	 * @return bool
	 */
	public function validate(array $credentials = [])
	{
		return true;
	}

	/**
	 * Set the current request instance.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return $this
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;

		return $this;
	}
}
