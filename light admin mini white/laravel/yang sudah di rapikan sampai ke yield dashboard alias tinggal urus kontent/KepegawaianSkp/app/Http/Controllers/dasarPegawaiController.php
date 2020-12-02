<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dasar;
use App\Pegawai;
use App\Telepon;

class dasarPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pegawai_id = Pegawai::where('id', Auth()->user()->id)->first();

        $pegawai = Pegawai::where('active', '1')->get();
        
        $dasar_pegawai = Dasar::where('active', '1')->get();

        $data_telepon = Telepon::where('active', '1')->get();
        
        return view('dasar_pegawai', compact(['pegawai', 'dasar_pegawai', 'data_telepon', 'pegawai_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       

        $pegawai = Pegawai::create([
            'eselon_1' => $request->eselon_1,
            'eselon_2' => $request->eselon_2,
            'eselon_3' => $request->eselon_3,
            'eselon_4' => $request->eselon_4,
            'nip_baru' => $request->nip_baru,
            'nip_lama' => $request->nip_lama,
            'nama_pegawai' => $request->nama_pegawai,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_keluarga' => $request->status_keluarga,
            'agama' => $request->agama,
            'pendidikan_akhir' => $request->pendidikan_akhir,
            'nama_sekolah' => $request->nama_sekolah,
            'tahun_lulus' => $request->tahun_lulus,
            'jurusan_prodi' => $request->jurusan_prodi,
            'status_kepegawaian' => $request->status_kepegawaian,
            'instansi_asal' => $request->instansi_asal,
            'tmt_cpns' => $request->tmt_cpns,
            'golongan' => $request->golongan,
            'tmt_golongan' => $request->tmt_golongan,
            'nama_jabatan' => $request->nama_jabatan,
            'nomor_karpeg' => $request->nomor_karpeg,
            'taspen' => $request->taspen,
            'nomor_npwp' => $request->nomor_npwp,
            'alamat_rumah' => $request->alamat_rumah,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'str' => $request->str,
            'masa_str' => $request->masa_str,
            'sikp' => $request->sikp,
            'masa_sikp' => $request->masa_sikp,
            'spk' => $request->spk,
            'masa_spk' => $request->masa_spk,
            'rkk' => $request->rkk,
            'masa_rkk' => $request->masa_rkk,
            'ruangan_id' => $request->input('ruangan', 1),
            'active' => $request->input('active', 1),
            'user_id' => auth()->user()->id,
        ]);

        $pegawai_id = Pegawai::where('id', Auth()->user()->id)->first();

        $dasar_pegawai = Dasar::create([
            'tahun' => $request->input('tahun', 2019),
            'pegawai_id' => $pegawai_id->id,
            'eselon_1' => $request->eselon_1,
            'eselon_2' => $request->eselon_2,
            'eselon_3' => $request->eselon_3,
            'eselon_4' => $request->eselon_4,
            'nip_baru' => $request->nip_baru,
            'nip_lama' => $request->nip_lama,
            'nama_pegawai' => $request->nama_pegawai,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_keluarga' => $request->status_keluarga,
            'agama' => $request->agama,
            'pendidikan_akhir' => $request->pendidikan_akhir,
            'nama_sekolah' => $request->nama_sekolah,
            'tahun_lulus' => $request->tahun_lulus,
            'jurusan_prodi' => $request->jurusan_prodi,
            'status_kepegawaian' => $request->status_kepegawaian,
            'instansi_asal' => $request->instansi_asal,
            'tmt_cpns' => $request->tmt_cpns,
            'golongan' => $request->golongan,
            'tmt_golongan' => $request->tmt_golongan,
            'nama_jabatan' => $request->nama_jabatan,
            'nomor_karpeg' => $request->nomor_karpeg,
            'taspen' => $request->taspen,
            'nomor_npwp' => $request->nomor_npwp,
            'alamat_rumah' => $request->alamat_rumah,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'str' => $request->str,
            'masa_str' => $request->masa_str,
            'sikp' => $request->sikp,
            'masa_sikp' => $request->masa_sikp,
            'spk' => $request->spk,
            'masa_spk' => $request->masa_spk,
            'rkk' => $request->rkk,
            'masa_rkk' => $request->masa_rkk,
            'ruangan_id' => $request->input('ruangan', 1),
            'active' => $request->input('active', 1),
        ]);


        $data_telepon = Telepon::create([
            'pegawai_id' => $pegawai_id->id,
            'telepon' => $request->telepon,
        ]);

    
        \Session::flash('Berhasil', 'Data dasar pegawai berhasil ditambahkan');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $pegawai = Pegawai::where('id', $id)->update([
            'eselon_1' => $request->eselon_1,
            'eselon_2' => $request->eselon_2,
            'eselon_3' => $request->eselon_3,
            'eselon_4' => $request->eselon_4,
            'nip_baru' => $request->nip_baru,
            'nip_lama' => $request->nip_lama,
            'nama_pegawai' => $request->nama_pegawai,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_keluarga' => $request->status_keluarga,
            'agama' => $request->agama,
            'pendidikan_akhir' => $request->pendidikan_akhir,
            'nama_sekolah' => $request->nama_sekolah,
            'tahun_lulus' => $request->tahun_lulus,
            'jurusan_prodi' => $request->jurusan_prodi,
            'status_kepegawaian' => $request->status_kepegawaian,
            'instansi_asal' => $request->instansi_asal,
            'tmt_cpns' => $request->tmt_cpns,
            'golongan' => $request->golongan,
            'tmt_golongan' => $request->tmt_golongan,
            'nama_jabatan' => $request->nama_jabatan,
            'nomor_karpeg' => $request->nomor_karpeg,
            'taspen' => $request->taspen,
            'nomor_npwp' => $request->nomor_npwp,
            'alamat_rumah' => $request->alamat_rumah,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'str' => $request->str,
            'masa_str' => $request->masa_str,
            'rkk' => $request->rkk,
            'masa_rkk' => $request->masa_rkk,
            'ruangan_id' => $request->input('ruangan', 1),
            'active' => $request->input('active', 1),
            'user_id' => auth()->user()->id,
        ]);

        $pegawai_id = Pegawai::where('id', Auth()->user()->id)->first();

        $data_telepon = Telepon::where('id', $id)->update([
            'pegawai_id' => $pegawai_id->id,
            'telepon' => $request->telepon,
        ]);

        $dasar_pegawai = Dasar::create([
            'tahun' => $request->input('tahun', 2019),
            'pegawai_id' => $pegawai_id->id,
            'eselon_1' => $request->eselon_1,
            'eselon_2' => $request->eselon_2,
            'eselon_3' => $request->eselon_3,
            'eselon_4' => $request->eselon_4,
            'nip_baru' => $request->nip_baru,
            'nip_lama' => $request->nip_lama,
            'nama_pegawai' => $request->nama_pegawai,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_keluarga' => $request->status_keluarga,
            'agama' => $request->agama,
            'pendidikan_akhir' => $request->pendidikan_akhir,
            'nama_sekolah' => $request->nama_sekolah,
            'tahun_lulus' => $request->tahun_lulus,
            'jurusan_prodi' => $request->jurusan_prodi,
            'status_kepegawaian' => $request->status_kepegawaian,
            'instansi_asal' => $request->instansi_asal,
            'tmt_cpns' => $request->tmt_cpns,
            'golongan' => $request->golongan,
            'tmt_golongan' => $request->tmt_golongan,
            'nama_jabatan' => $request->nama_jabatan,
            'nomor_karpeg' => $request->nomor_karpeg,
            'taspen' => $request->taspen,
            'nomor_npwp' => $request->nomor_npwp,
            'alamat_rumah' => $request->alamat_rumah,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'str' => $request->str,
            'masa_str' => $request->masa_str,
            'sikp' => $request->sikp,
            'masa_sikp' => $request->masa_sikp,
            'spk' => $request->spk,
            'masa_spk' => $request->masa_spk,
            'rkk' => $request->rkk,
            'masa_rkk' => $request->masa_rkk,
            'ruangan_id' => $request->input('ruangan', 1),
            'active' => $request->input('active', 1),
        ]);


        \Session::flash('Berhasil', 'Data dasar pegawai berhasil diupdate');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::where('id', $id)->delete();

        \Session::flash('Berhasil', 'Data dasar pegawai berhasil dihapus');

        return back();
    }
}
