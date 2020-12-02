<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $table = 'setting';
    protected $fillable = [
        'tahun',
        'terakhir_isi_skp',
        'pesan_skp',
        'active_skp',
        'created_at',
        'updated_at'
    ];
}
