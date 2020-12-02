<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiklatPenjenjangan extends Model
{
    //
    protected $table = 'diklat_penjenjangan';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'jenis_diklat',
        'angkatan',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_jam',
        'penyelenggara',
        'predikat',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
