<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

function storeFile($berkas, $folder)
{
    $uploadedFile = $berkas;
    $nama = time();
    $extension =  $uploadedFile->getClientOriginalExtension();
    $namafile = $nama . '.' . $extension;
    Storage::putFileAs('public/' . $folder . '/', $berkas, $namafile);
    $location = 'storage/' . $folder . '/' . $namafile;

    return $location;
}

function storeFileBase64($base64_data, $folder)
{
    $extension = explode('/', explode(':', substr($base64_data, 0, strpos($base64_data, ';')))[1])[1];   // .jpg .png .pdf
    $replace = substr($base64_data, 0, strpos($base64_data, ',') + 1);
    // find substring fro replace here eg: data:image/png;base64,
    $image = str_replace($replace, '', $base64_data);
    $image = str_replace(' ', '+', $image);
    $location = $folder . '/' . Str::random(10) . '.' . $extension;
    $berkas = base64_decode($image);

    Storage::disk('public')->put($location, $berkas);
    $location = 'storage/' . $location;

    return $location;
}

function getSetting()
{
    $setting = Setting::find('1');

    return $setting;
}



function curlGet($url)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $respon = curl_exec($curl);
    curl_close($curl);

    return json_decode($respon);
}

function getcurrentservertime()
{
    return now()->format('H:i');
}

function getMetodePembayaran()
{
    return [
        'Cash',
        'Transfer',
    ];
}
