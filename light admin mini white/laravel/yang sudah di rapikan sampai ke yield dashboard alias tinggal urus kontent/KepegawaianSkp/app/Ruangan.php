<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    //
    protected $table = 'ruangan';
    protected $fillable = [
        'ruangan',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->hasMany('App\Pegawai', 'ruangan_id');
    }

    public function dasar()
    {
        return $this->hasMany('App\Dasar', 'ruangan_id');
    }
}
