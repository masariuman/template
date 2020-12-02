<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hukuman extends Model
{
    //
    protected $table = 'hukuman';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'kode_hukuman',
        'nomor_sk',
        'tanggal_sk',
        'tmt_berlaku',
        'pejabat_pembuat_sk',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
