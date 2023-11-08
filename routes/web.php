<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/privacy-policy', 'HomeController@privacyPolicy');

Route::get('/', function () {
	// return redirect()->route('home','1');
	return redirect()->route('login');
})->middleware('guest');

Auth::routes([
	'register' => false
]);
Route::post('login', 'Auth\LoginController@postLogin');
Route::get('/landing', 'HomeController@index')->name('home');

Route::middleware('auth:user')->group(function () {
	Route::get('/dashboard', 'HomeController@index')->name('dashboard');
	Route::get('/homeahli', 'HomeController@homeAhli')->name('homeahli');
	Route::get('/homeadmin', 'HomeController@home')->name('homeadmin');

	Route::prefix('profile')->name('profile.')->group(function () {
		Route::get('/', 'ProfileController@edit')->name('edit');
		Route::post('/store', 'ProfileController@store')->name('store');
	});

	Route::middleware(['can:MasterData'])->prefix('masterdata')->name('masterdata.')->group(function () {
		Route::middleware(['can:MasterPenduduk'])->prefix('penduduk')->name('penduduk.')->group(function () {
			Route::get('/', 'MasterPendudukController@index')->name('home');
			Route::get('/data', 'MasterPendudukController@data')->name('data');
			Route::get('/create', 'MasterPendudukController@create')->name('create');
			Route::get('/edit{id}', 'MasterPendudukController@edit')->name('edit');
			Route::post('/store', 'MasterPendudukController@store')->name('store');
		});
		Route::middleware(['can:MasterPerangkatDesa'])->prefix('perangkatdesa')->name('perangkatdesa.')->group(function () {
			Route::get('/', 'MasterPerangkatDesaController@index')->name('home');
			Route::get('/data', 'MasterPerangkatDesaController@data')->name('data');
			Route::get('/create', 'MasterPerangkatDesaController@create')->name('create');
			Route::get('/edit{id}', 'MasterPerangkatDesaController@edit')->name('edit');
			Route::post('/store', 'MasterPerangkatDesaController@store')->name('store');
		});

		Route::controller(MasterData\BidangController::class)->prefix('bidang')->name('bidang.')->group(function () {
			Route::get('/', 'index')->name('home');
			Route::get('/dtB1', 'dtB1')->name('dtB1');
			Route::get('/dtB2', 'dtB2')->name('dtB2');
			Route::get('/dtB3', 'dtB3')->name('dtB3');
			Route::get('/create', 'create')->name('create');
			Route::post('/store', 'store')->name('store');
			Route::get('/destroy', 'destroy')->name('destroy');
		});

		Route::controller(MasterData\RekController::class)->prefix('rek')->name('rek.')->group(function () {
			Route::get('/', 'index')->name('home');
			Route::get('/dtB1', 'dtB1')->name('dtB1');
			Route::get('/dtB2', 'dtB2')->name('dtB2');
			Route::get('/dtB3', 'dtB3')->name('dtB3');
			Route::get('/dtB4', 'dtB4')->name('dtB4');
			Route::get('/create', 'create')->name('create');
			Route::post('/store', 'store')->name('store');
			Route::get('/destroy', 'destroy')->name('destroy');
		});
	});

	#  ADMIN LAYANAN KESEHATAN 
	Route::middleware(['can:LayananKesehatan'])->prefix('layanankesehatan')->name('layanankesehatan.')->group(function () {
		Route::get('/', 'LayananKesehatanController@index')->name('home');
		Route::get('/data', 'LayananKesehatanController@data')->name('data');
		Route::get('/create', 'LayananKesehatanController@create')->name('create');
		Route::get('/edit{id}', 'LayananKesehatanController@edit')->name('edit');
		Route::post('/store', 'LayananKesehatanController@store')->name('store');
	});

	#  ADMIN KEUANGAN 
	Route::controller(\KeuanganController::class)->middleware(['can:Keuangan'])->prefix('keuangan')->name('keuangan.')->group(function () {
		Route::get('/', 'index')->name('home');
		Route::get('/dt', 'dt')->name('dt');
		Route::get('/create', 'create')->name('create');
		Route::post('/store', 'store')->name('store');
		Route::get('/destroy', 'destroy')->name('destroy');

		Route::prefix('kelola')->name('kelola.')->group(function () {
			Route::get('/', 'kelola')->name('home');
			Route::get('/dt', 'kelolaDt')->name('dt');
			Route::post('/store', 'kelolaStore')->name('store');
			Route::get('/destroy', 'kelolaDestroy')->name('destroy');
		});
	});

	#  ADMIN DESA CERDAS
	Route::middleware(['can:DesaCerdas'])->prefix('desacerdas')->name('desacerdas.')->group(function () {
		Route::get('/', 'DesaCerdasController@index')->name('home');
		Route::get('/data', 'DesaCerdasController@data')->name('data');
		Route::get('/create', 'DesaCerdasController@create')->name('create');
		Route::get('/edit{id}', 'DesaCerdasController@edit')->name('edit');
		Route::post('/store', 'DesaCerdasController@store')->name('store');
	});

	#  USER PENDUDUK
	Route::middleware(['can:Penduduk'])->prefix('penduduk')->name('penduduk.')->group(function () {
		Route::middleware(['can:Pengajuan'])->prefix('pengajuan')->name('pengajuan.')->group(function () {
			Route::get('/', 'PengajuanController@pengajuanadd')->name('home');
			Route::get('/permohonan', 'PengajuanController@permohonan')->name('permohonan');
			Route::get('/data', 'PengajuanController@data')->name('data');
			Route::get('/create', 'PengajuanController@create')->name('create');
			Route::get('/edit{id}', 'PengajuanController@edit')->name('edit');
			Route::post('/store', 'PengajuanController@store')->name('store');
		});
	});

	#USER ADMIN
	Route::middleware(['can:MasterPengajuan'])->prefix('masterpengajuan')->name('masterpengajuan.')->group(function () {
		Route::get('/', 'PengajuanController@masterpengajuan')->name('home');
		Route::get('/datamasterpengajuan', 'PengajuanController@datamasterpengajuan')->name('datamasterpengajuan');
		Route::get('/prosessurat/{id?}', 'PengajuanController@prosessurat')->name('prosessurat');
		Route::put('/uploadtte/{pengajuan?}', 'PengajuanController@uploadTte')->name('uploadtte');
		Route::post('/storepengajuan', 'PengajuanController@storepengajuan')->name('storepengajuan');
		Route::get('/suketahliwaris/{id?}', 'PengajuanController@suketahliwaris')->name('suketahliwaris');
		Route::post('/storesuketahliwaris', 'PengajuanController@storesuketahliwaris')->name('storesuketahliwaris');
		Route::get('/suketdomisilianaksekolah/{id?}', 'PengajuanController@suketdomisilianaksekolah')->name('suketdomisilianaksekolah');
		Route::post('/storesuketdomisilianaksekolah', 'PengajuanController@storesuketdomisilianaksekolah')->name('storesuketdomisilianaksekolah');
		Route::get('/suketdomisilipura/{id?}', 'PengajuanController@suketdomisilipura')->name('suketdomisilipura');
		Route::post('/storesuketdomisilipura', 'PengajuanController@storesuketdomisilipura')->name('storesuketdomisilipura');
		Route::get('/suketdtks/{id?}', 'PengajuanController@suketdtks')->name('suketdtks');
		Route::post('/storesuketdtks', 'PengajuanController@storesuketdtks')->name('storesuketdtks');
		Route::get('/suketjandaduda/{id?}', 'PengajuanController@suketjandaduda')->name('suketjandaduda');
		Route::post('/storesuketjandaduda', 'PengajuanController@storesuketjandaduda')->name('storesuketjandaduda');
		Route::get('/suketkelahiran/{id?}', 'PengajuanController@suketkelahiran')->name('suketkelahiran');
		Route::post('/storesuketkelahiran', 'PengajuanController@storesuketkelahiran')->name('storesuketkelahiran');
		Route::get('/suketletaktanah/{id?}', 'PengajuanController@suketletaktanah')->name('suketletaktanah');
		Route::post('/storesuketletaktanah', 'PengajuanController@storesuketletaktanah')->name('storesuketletaktanah');
		Route::get('/suketmenempatitanah/{id?}', 'PengajuanController@suketmenempatitanah')->name('suketmenempatitanah');
		Route::post('/storesuketmenempatitanah', 'PengajuanController@storesuketmenempatitanah')->name('storesuketmenempatitanah');
		Route::get('/suketmenikah/{id?}', 'PengajuanController@suketmenikah')->name('suketmenikah');
		Route::post('/storesuketmenikah', 'PengajuanController@storesuketmenikah')->name('storesuketmenikah');
		Route::get('/suketmeninggal/{id?}', 'PengajuanController@suketmeninggal')->name('suketmeninggal');
		Route::post('/storesuketmeninggal', 'PengajuanController@storesuketmeninggal')->name('storesuketmeninggal');
		Route::get('/suketnamaalias/{id?}', 'PengajuanController@suketnamaalias')->name('suketnamaalias');
		Route::post('/storesuketnamaalias', 'PengajuanController@storesuketnamaalias')->name('storesuketnamaalias');
		Route::get('/suketpindahdomisili/{id?}', 'PengajuanController@suketpindahdomisili')->name('suketpindahdomisili');
		Route::post('/storesuketpindahdomisili', 'PengajuanController@storesuketpindahdomisili')->name('storesuketpindahdomisili');
		Route::get('/suketsudahmampu/{id?}', 'PengajuanController@suketsudahmampu')->name('suketsudahmampu');
		Route::post('/storesuketsudahmampu', 'PengajuanController@storesuketsudahmampu')->name('storesuketsudahmampu');
		Route::get('/sukettempatusaha/{id?}', 'PengajuanController@sukettempatusaha')->name('sukettempatusaha');
		Route::post('/storesukettempatusaha', 'PengajuanController@storesukettempatusaha')->name('storesukettempatusaha');
		Route::get('/suketdatatercecer/{id?}', 'PengajuanController@suketdatatercecer')->name('suketdatatercecer');
		Route::post('/storesuketdatatercecer', 'PengajuanController@storesuketdatatercecer')->name('storesuketdatatercecer');
		Route::get('/sukettidakmampu/{id?}', 'PengajuanController@sukettidakmampu')->name('sukettidakmampu');
		Route::post('/storesukettidakmampu', 'PengajuanController@storesukettidakmampu')->name('storesukettidakmampu');
		Route::get('/sukettidakmemilikitempattinggal/{id?}', 'PengajuanController@sukettidakmemilikitempattinggal')->name('sukettidakmemilikitempattinggal');
		Route::post('/storesukettidakmemilikitempattinggal', 'PengajuanController@storesukettidakmemilikitempattinggal')->name('storesukettidakmemilikitempattinggal');
		Route::get('/sukettidakmemilikiketurunan/{id?}', 'PengajuanController@sukettidakmemilikiketurunan')->name('sukettidakmemilikiketurunan');
		Route::post('/storesukettidakmemilikiketurunan', 'PengajuanController@storesukettidakmemilikiketurunan')->name('storesukettidakmemilikiketurunan');
		Route::get('/suketusahadagang/{id?}', 'PengajuanController@suketusahadagang')->name('suketusahadagang');
		Route::post('/storesuketusahadagang', 'PengajuanController@storesuketusahadagang')->name('storesuketusahadagang');
		Route::get('/suketyatimpiatu/{id?}', 'PengajuanController@suketyatimpiatu')->name('suketyatimpiatu');
		Route::post('/storesuketyatimpiatu', 'PengajuanController@storesuketyatimpiatu')->name('storesuketyatimpiatu');
		Route::get('/suketdomisili/{id?}', 'PengajuanController@suketdomisili')->name('suketdomisili');
		Route::post('/storesuketdomisili', 'PengajuanController@storesuketdomisili')->name('storesuketdomisili');
		Route::get('/suketusahadagangkadus/{id?}', 'PengajuanController@suketusahadagangkadus')->name('suketusahadagangkadus');
		Route::post('/storesuketusahadagangkadus', 'PengajuanController@storesuketusahadagangkadus')->name('storesuketusahadagangkadus');
		Route::get('/setujui/{status?}/{id?}', 'PengajuanController@setujui')->name('setujui');
	});
});

Route::prefix('report')->name('report.')->group(function () {
	Route::get('/suketbelumkawin/{id}', 'ReportController@suketbelumkawin')->name('suketbelumkawin');
	Route::get('/suketahliwaris/{id}', 'ReportController@suketahliwaris')->name('suketahliwaris');
	Route::get('/suketdomisilianaksekolah/{id}', 'ReportController@suketdomisilianaksekolah')->name('suketdomisilianaksekolah');
	Route::get('/suketdomisilipura/{id}', 'ReportController@suketdomisilipura')->name('suketdomisilipura');
	Route::get('/suketdtks/{id}', 'ReportController@suketdtks')->name('suketdtks');
	Route::get('/suketjandaduda/{id}', 'ReportController@suketjandaduda')->name('suketjandaduda');
	Route::get('/suketkelahiran/{id}', 'ReportController@suketkelahiran')->name('suketkelahiran');
	Route::get('/suketletaktanah/{id}', 'ReportController@suketletaktanah')->name('suketletaktanah');
	Route::get('/suketmenempatitanah/{id}', 'ReportController@suketmenempatitanah')->name('suketmenempatitanah');
	Route::get('/suketmenikah/{id}', 'ReportController@suketmenikah')->name('suketmenikah');
	Route::get('/suketmeninggal/{id}', 'ReportController@suketmeninggal')->name('suketmeninggal');
	Route::get('/suketnamaalias/{id}', 'ReportController@suketnamaalias')->name('suketnamaalias');
	Route::get('/suketpindahdomisili/{id}', 'ReportController@suketpindahdomisili')->name('suketpindahdomisili');
	Route::get('/suketsudahmampu/{id}', 'ReportController@suketsudahmampu')->name('suketsudahmampu');
	Route::get('/sukettempatusaha/{id}', 'ReportController@sukettempatusaha')->name('sukettempatusaha');
	Route::get('/suketdatatercecer/{id}', 'ReportController@suketdatatercecer')->name('suketdatatercecer');
	Route::get('/sukettidakmampu/{id}', 'ReportController@sukettidakmampu')->name('sukettidakmampu');
	Route::get('/sukettidakmemilikitempattinggal/{id}', 'ReportController@sukettidakmemilikitempattinggal')->name('sukettidakmemilikitempattinggal');
	Route::get('/sukettidakmemilikiketurunan/{id}', 'ReportController@sukettidakmemilikiketurunan')->name('sukettidakmemilikiketurunan');
	Route::get('/suketusahadagang/{id}', 'ReportController@suketusahadagang')->name('suketusahadagang');
	Route::get('/suketyatimpiatu/{id}', 'ReportController@suketyatimpiatu')->name('suketyatimpiatu');
	Route::get('/suketdomisili/{id}', 'ReportController@suketdomisili')->name('suketdomisili');
	Route::get('/suketusahadagangkadus', 'ReportController@suketusahadagangkadus')->name('suketusahadagangkadus');
});
