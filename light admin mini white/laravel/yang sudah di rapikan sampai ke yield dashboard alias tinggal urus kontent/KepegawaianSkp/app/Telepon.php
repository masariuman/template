<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telepon extends Model
{
    //
    protected $table = 'telepon';
    protected $fillable = [
        'pegawai_id',
        'telepon',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }
}
