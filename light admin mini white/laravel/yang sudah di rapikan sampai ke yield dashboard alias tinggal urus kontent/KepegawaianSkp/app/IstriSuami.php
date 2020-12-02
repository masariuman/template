<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IstriSuami extends Model
{
    //
    protected $table = 'istri_suami';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'nama',
        'nomor_karis_karsu',
        'tanggal_lahir',
        'tanggal_nikah',
        'tingkat_pendidikan',
        'pekerjaan',
        'status_suami_istri',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
