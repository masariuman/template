<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\PekerjaanJabatan;

class riwayatPekerjaanJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayat_pekerjaan_jabatan = PekerjaanJabatan::where('active', '1')->get();
        return view('riwayat_pekerjaan-jabatan', compact('riwayat_pekerjaan_jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawai_id = Pegawai::where('id', Auth()->user()->id)->first();

        $riwayat_pekerjaan_jabatan = PekerjaanJabatan::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_jabatan' => $request->nama_jabatan,
            'tmt_jabatan' => $request->tmt_jabatan,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'nip_pejabat_penandatangan_sk' => $request->nip_pejabat_penandatangan_sk,
            'nip_lama_pejabat_penandatangan_sk' => $request->nip_lama_pejabat_penandatangan_sk,
            'pejabat_penandatangan_sk' => $request->pejabat_penandatangan_sk,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data riwayat pekerjaaan / jabatan berhasil ditambahkan');

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
        $pegawai_id = Pegawai::where('id', Auth()->user()->id)->first();

        $riwayat_pekerjaan_jabatan = PekerjaanJabatan::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_jabatan' => $request->nama_jabatan,
            'tmt_jabatan' => $request->tmt_jabatan,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'nip_pejabat_penandatangan_sk' => $request->nip_pejabat_penandatangan_sk,
            'nip_lama_pejabat_penandatangan_sk' => $request->nip_lama_pejabat_penandatangan_sk,
            'pejabat_penandatangan_sk' => $request->pejabat_penandatangan_sk,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data riwayat pekerjaaan / jabatan berhasil diubah');

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
        $riwayat_pekerjaan_jabatan = PekerjaanJabatan::where('id', $id)->delete();

        \Session::flash('Berhasil', 'Data riwayat pekerjaaan / jabatan berhasil dihapus');

        return back();
    }
}
