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

Route::group(['middleware'=>['auth','checkRole:PEGAWAI']], function () {
    Route::get('/', 'dasarPegawaiController@index')->name('dasar_pegawai');
    Route::get('/dasar_pegawai/baru', 'dasarPegawaiController@create');
    Route::post('/dasar_pegawai/tambah', 'dasarPegawaiController@store')->name('dasar_pegawai_tambah');
    Route::get('/dasar_pegawai/{id}/ubah', 'dasarPegawaiController@edit');
    Route::patch('/dasar_pegawai/update/{id}', 'dasarPegawaiController@update');
    Route::delete('/dasar_pegawai/delete/{id}', 'dasarPegawaiController@destroy');

    Route::get('/riwayat_pendidikan_formal', 'riwayatPendidikanFormalController@index')->name('riwayat_pendidikan_formal');
    Route::get('/riwayat_pendidikan_formal/baru', 'riwayatPendidikanFormalController@create');
    Route::post('/riwayat_pendidikan_formal/tambah', 'riwayatPendidikanFormalController@store')->name('riwayat_pendidikan_formal_tambah');
    Route::get('/riwayat_pendidikan_formal/{id}/ubah', 'riwayatPendidikanFormalController@edit');
    Route::patch('/riwayat_pendidikan_formal/update/{id}', 'riwayatPendidikanFormalController@update');
    Route::delete('/riwayat_pendidikan_formal/delete/{id}', 'riwayatPendidikanFormalController@destroy');

    Route::get('/riwayat_diklat_fungsional', 'riwayatDiklatFungsionalController@index')->name('riwayat_diklat_fungsional');
    Route::get('/riwayat_diklat_fungsional/baru', 'riwayatDiklatFungsionalController@create');
    Route::post('/riwayat_diklat_fungsional/tambah', 'riwayatDiklatFungsionalController@store')->name('riwayat_diklat_fungsional_tambah');
    Route::get('/riwayat_diklat_fungsional/{id}/ubah', 'riwayatDiklatFungsionalController@edit');
    Route::patch('/riwayat_diklat_fungsional/update/{id}', 'riwayatDiklatFungsionalController@update');
    Route::delete('/riwayat_diklat_fungsional/delete/{id}', 'riwayatDiklatFungsionalController@destroy');

    Route::get('/riwayat_diklat_teknis', 'riwayatDiklatTeknisController@index')->name('riwayat_diklat_teknis');
    Route::get('/riwayat_diklat_teknis/baru', 'riwayatDiklatTeknisController@create');
    Route::post('/riwayat_diklat_teknis/tambah', 'riwayatDiklatTeknisController@store')->name('riwayat_diklat_teknis_tambah');
    Route::get('/riwayat_diklat_teknis/{id}/ubah', 'riwayatDiklatTeknisController@edit');
    Route::patch('/riwayat_diklat_teknis/update/{id}', 'riwayatDiklatTeknisController@update');
    Route::delete('/riwayat_diklat_teknis/delete/{id}', 'riwayatDiklatTeknisController@destroy');

    Route::get('/riwayat_diklat_penjenjangan_struktural', 'riwayatDiklatPenjenjanganStrukturalController@index')->name('riwayat_diklat_penjenjangan_struktural');
    Route::get('/riwayat_diklat_penjenjangan_struktural/baru', 'riwayatDiklatPenjenjanganStrukturalController@create');
    Route::post('/riwayat_diklat_penjenjangan_struktural/tambah', 'riwayatDiklatPenjenjanganStrukturalController@store')->name('riwayat_diklat_penjenjangan_struktural_tambah');
    Route::get('/riwayat_diklat_penjenjangan_struktural/{id}/ubah', 'riwayatDiklatPenjenjanganStrukturalController@edit');
    Route::patch('/riwayat_diklat_penjenjangan_struktural/update/{id}', 'riwayatDiklatPenjenjanganStrukturalController@update');
    Route::delete('/riwayat_diklat_penjenjangan_struktural/delete/{id}', 'riwayatDiklatPenjenjanganStrukturalController@destroy');

    Route::get('/riwayat_kepangkatan', 'riwayatKepangkatanController@index')->name('riwayat_kepangkatan');
    Route::get('/riwayat_kepangkatan/baru', 'riwayatKepangkatanController@create');
    Route::post('/riwayat_kepangkatan/tambah', 'riwayatKepangkatanController@store')->name('riwayat_kepangkatan_tambah');
    Route::get('/riwayat_kepangkatan/{id}/ubah', 'riwayatKepangkatanController@edit');
    Route::patch('/riwayat_kepangkatan/update/{id}', 'riwayatKepangkatanController@update');
    Route::delete('/riwayat_kepangkatan/delete/{id}', 'riwayatKepangkatanController@destroy');

    Route::get('/riwayat_jabatan_struktural', 'riwayatJabatanStrukturalController@index')->name('riwayat_jabatan_struktural');
    Route::get('/riwayat_jabatan_struktural/baru', 'riwayatJabatanStrukturalController@create');
    Route::post('/riwayat_jabatan_struktural/tambah', 'riwayatJabatanStrukturalController@store')->name('riwayat_jabatan_struktural_tambah');
    Route::get('/riwayat_jabatan_struktural/{id}/ubah', 'riwayatJabatanStrukturalController@edit');
    Route::patch('/riwayat_jabatan_struktural/update/{id}', 'riwayatJabatanStrukturalController@update');
    Route::delete('/riwayat_jabatan_struktural/delete/{id}', 'riwayatJabatanStrukturalController@destroy');

    Route::get('/riwayat_jabatan_fungsional', 'riwayatJabatanFungsionalController@index')->name('riwayat_jabatan_fungsional');
    Route::get('/riwayat_jabatan_fungsional/baru', 'riwayatJabatanFungsionalController@create');
    Route::post('/riwayat_jabatan_fungsional/tambah', 'riwayatJabatanFungsionalController@store')->name('riwayat_jabatan_fungsional_tambah');
    Route::get('/riwayat_jabatan_fungsional/{id}/ubah', 'riwayatJabatanFungsionalController@edit');
    Route::patch('/riwayat_jabatan_fungsional/update/{id}', 'riwayatJabatanFungsionalController@update');
    Route::delete('/riwayat_jabatan_fungsional/delete/{id}', 'riwayatJabatanFungsionalController@destroy');

    Route::get('/istri_suami', 'istriSuamiController@index')->name('istri_suami');
    Route::get('/istri_suami/baru', 'istriSuamiController@create');
    Route::post('/istri_suami/tambah', 'istriSuamiController@store')->name('istri_suami_tambah');
    Route::get('/istri_suami/{id}/ubah', 'istriSuamiController@edit');
    Route::patch('/istri_suami/update/{id}', 'istriSuamiController@update');
    Route::delete('/istri_suami/delete/{id}', 'istriSuamiController@destroy');

    Route::get('table', 'anakController@getTable')->name('getTable');
    Route::get('/anak', 'anakController@index')->name('anak');
    Route::get('/anak/baru', 'anakController@create');
    Route::post('/anak/tambah', 'anakController@store')->name('anak_tambah');
    Route::get('/anak/{id}/ubah', 'anakController@edit');
    Route::patch('/anak/update/{id}', 'anakController@update');
    Route::delete('/anak/delete/{id}', 'anakController@destroy');

    Route::get('/seminar_lokakarya_simposium', 'seminarController@index')->name('seminar_lokakarya_simposium');
    Route::get('/seminar_lokakarya_simposium/baru', 'seminarController@create');
    Route::post('/seminar_lokakarya_simposium/tambah', 'seminarController@store')->name('seminar_lokakarya_simposium_tambah');
    Route::get('/seminar_lokakarya_simposium/{id}/ubah', 'seminarController@edit');
    Route::patch('/seminar_lokakarya_simposium/update/{id}', 'seminarController@update');
    Route::delete('/seminar_lokakarya_simposium/delete/{id}', 'seminarController@destroy');

    Route::get('/tanda_jasa_penghargaan', 'penghargaanController@index')->name('tanda_jasa_penghargaan');
    Route::get('/tanda_jasa_penghargaan/baru', 'penghargaanController@create');
    Route::post('/tanda_jasa_penghargaan/tambah', 'penghargaanController@store')->name('tanda_jasa_penghargaan_tambah');
    Route::get('/tanda_jasa_penghargaan/{id}/ubah', 'penghargaanController@edit');
    Route::patch('/tanda_jasa_penghargaan/update/{id}', 'penghargaanController@update');
    Route::delete('/tanda_jasa_penghargaan/delete/{id}', 'penghargaanController@destroy');

    Route::get('/hukum_disiplin', 'hukumanController@index')->name('hukum_disiplin');
    Route::get('/hukum_disiplin/baru', 'hukumanController@create');
    Route::post('/hukum_disiplin/tambah', 'hukumanController@store')->name('hukum_disiplin_tambah');
    Route::get('/hukum_disiplin/{id}/ubah', 'hukumanController@edit');
    Route::patch('/hukum_disiplin/update/{id}', 'hukumanController@update');
    Route::delete('/hukum_disiplin/delete/{id}', 'hukumanController@destroy');

    Route::get('/keanggotaan_organisasi', 'organisasiController@index')->name('keanggotaan_organisasi');
    Route::get('/keanggotaan_organisasi/baru', 'organisasiController@create');
    Route::post('/keanggotaan_organisasi/tambah', 'organisasiController@store')->name('keanggotaan_organisasi_tambah');
    Route::get('/keanggotaan_organisasi/{id}/ubah', 'organisasiController@edit');
    Route::patch('/keanggotaan_organisasi/update/{id}', 'organisasiController@update');
    Route::delete('/keanggotaan_organisasi/delete/{id}', 'organisasiController@destroy');

    Route::get('/keluarga_kandung', 'keluargaKandungController@index')->name('keluarga_kandung');
    Route::get('/keluarga_kandung/baru', 'keluargaKandungController@create');
    Route::post('/keluarga_kandung/tambah', 'keluargaKandungController@store')->name('keluarga_kandung_tambah');
    Route::get('/keluarga_kandung/{id}/ubah', 'keluargaKandungController@edit');
    Route::patch('/keluarga_kandung/update/{id}', 'keluargaKandungController@update');
    Route::delete('/keluarga_kandung/delete/{id}', 'keluargaKandungController@destroy');

    Route::get('/keluarga_istri_suami', 'keluargaIstriSuamiController@index')->name('keluarga_istri_suami');
    Route::get('/keluarga_istri_suami/baru', 'keluargaIstriSuamiController@create');
    Route::post('/keluarga_istri_suami/tambah', 'keluargaIstriSuamiController@store')->name('keluarga_istri_suami_tambah');
    Route::get('/keluarga_istri_suami/{id}/ubah', 'keluargaIstriSuamiController@edit');
    Route::patch('/keluarga_istri_suami/update/{id}', 'keluargaIstriSuamiController@update');
    Route::delete('/keluarga_istri_suami/delete/{id}', 'keluargaIstriSuamiController@destroy');

    Route::get('/riwayat_pekerjaan_jabatan', 'riwayatPekerjaanJabatanController@index')->name('riwayat_pekerjaan_jabatan');
    Route::get('/riwayat_pekerjaan_jabatan/baru', 'riwayatPekerjaanJabatanController@create');
    Route::post('/riwayat_pekerjaan_jabatan', 'riwayatPekerjaanJabatanController@store')->name('riwayat_pekerjaan_jabatan_tambah');
    Route::get('/riwayat_pekerjaan_jabatan/{id}/ubah', 'riwayatPekerjaanJabatanController@edit');
    Route::patch('/riwayat_pekerjaan_jabatan/update/{id}', 'riwayatPekerjaanJabatanController@update');
    Route::delete('/riwayat_pekerjaan_jabatan/delete/{id}', 'riwayatPekerjaanJabatanController@destroy');
});

Route::group(['prefix' => 'admin', 'middleware'=>['auth','checkRole:TU']], function () {
    Route::resource('/','adminDashboardController');
    Route::get('/pegawai/{id}/skp','adminPegawaiController@skp');
    Route::resource('/pegawai','adminPegawaiController');
    Route::resource('/ruangan','adminRuanganController');
    Route::resource('/setting','adminSettingController');
});



Route::resource('it/admin','adminDashboardController');
Route::group(['prefix' => 'it', 'middleware'=>['auth','checkRole:ADMIN']], function () {

    Route::get('/pegawai/{id}/skp','adminPegawaiController@skp');
    Route::post('/pegawai/{id}/skp','adminPegawaiController@skp_filter');
    Route::resource('/pegawai','adminPegawaiController');
    Route::resource('/ruangan','adminRuanganController');
    Route::resource('/periode','periodeController');
    Route::resource('/setting','adminSettingController');
});

Auth::routes();
