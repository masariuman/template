<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kepangkatan extends Model
{
    //
    protected $table = 'kepangkatan';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'golongan',
        'tmt_golongan',
        'pejabat_penandatangan_sk',
        'nomor_sk',
        'tanggal_sk',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
