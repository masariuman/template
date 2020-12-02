<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    //
    protected $table = 'anak';
    protected $fillable = [
    	'tahun',
        'pegawai_id',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_anak',
        'pendidikan',
        'pekerjaan',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
