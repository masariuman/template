<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dasar extends Model
{
    //
    protected $table = 'dasar';
    protected $fillable = [
        'tahun',
        'pegawai_id',
        'eselon_1',
        'eselon_2',
        'eselon_3',
        'eselon_4',
        'nip_baru',
        'nip_lama',
        'nama_pegawai',
        'gelar_depan',
        'gelar_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_keluarga',
        'agama',
        'pendidikan_akhir',
        'nama_sekolah',
        'tahun_lulus',
        'jurusan_prodi',
        'status_kepegawaian',
        'instansi_asal',
        'tmt_cpns',
        'golongan',
        'tmt_golongan',
        'nama_jabatan',
        'nomor_karpeg',
        'taspen',
        'nomor_npwp',
        'alamat_rumah',
        'kota',
        'kode_pos',
        'str',
        'masa_str',
        'sikp',
        'masa_sikp',
        'spk',
        'masa_spk',
        'rkk',
        'masa_rkk',
        'ruangan_id',
        'active',
        'created_at',
        'updated_at'
    ];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id');
    }

    public function ruangan()
    {
        return $this->belongsTo('App\Ruangan', 'ruangan_id');
    }
}
