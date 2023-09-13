<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MPengajuanController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function (Request $request) {
	return $request;
});

Route::post('/login', [LoginController::class, 'doLogin']);

Route::middleware(['auth:api'])->group(function () {
	Route::post('/logout', [LoginController::class, 'doLogout']);
	Route::get('/user', function (Request $request) {
		$request->user()->penduduk;
		return ['user' => $request->user()];
	});

	
	Route::controller(MPengajuanController::class)->group(function () {
		Route::get('/md/jenis-dokumen', 'dokJenisMD');
		Route::get('/md/keluarga', 'keluargaMD');

		Route::prefix('/pengajuan')->group(function () {
			Route::get('/dt', 'pengajuanDt');
			Route::post('/', 'pengajuanStore');
			Route::put('/{pengajuan}/verif', 'pengajuanVerif');
		});
	});
});
