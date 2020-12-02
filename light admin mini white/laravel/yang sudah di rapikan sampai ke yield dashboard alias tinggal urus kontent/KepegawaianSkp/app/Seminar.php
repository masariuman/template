<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    //
    protected $table = 'seminar';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'nama_kegiatan',
        'lokasi',
        'tempat_kegiatan',
        'penyelenggara',
        'tahun_seminar',
        'kedudukan_dalam_seminar',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
