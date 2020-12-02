<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    //
    protected $table = 'periode';
    protected $fillable = [
        'tahun',
        'periode',
        'created_at',
        'updated_at'
    ];
}
