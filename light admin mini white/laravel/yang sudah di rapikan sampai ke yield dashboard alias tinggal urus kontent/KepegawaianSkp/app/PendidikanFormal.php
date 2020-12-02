<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendidikanFormal extends Model
{
    //
    protected $table = 'pendidikan_formal';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'tingkat_pendidikan',
        'nama_sekolah',
        'jurusan_prodi',
        'tahun_masuk',
        'tahun_lulus',
        'tempat_belajar',
        'lokasi',
        'nomor_ijazah',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
