<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeluargaKandung extends Model
{
    //
    protected $table = 'keluarga_kandung';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'nama',
        'hubungan',
        'pekerjaan',
        'tanggal_lahir',
        'jenis_kelamin',
        'kondisi',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
