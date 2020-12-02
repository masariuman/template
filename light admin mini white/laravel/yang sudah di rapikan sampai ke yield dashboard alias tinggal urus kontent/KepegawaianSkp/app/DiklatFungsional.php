<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiklatFungsional extends Model
{
    //
    protected $table = 'diklat_fungsional';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'nama_diklat',
        'tempat_belajar',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_jam',
        'penyelenggara',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
