<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    //
    protected $table = 'penghargaan';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'nama_penghargaan',
        'tanggal_perolehan',
        'nomor',
        'pemberi',
        'jabatan_pemberi',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
