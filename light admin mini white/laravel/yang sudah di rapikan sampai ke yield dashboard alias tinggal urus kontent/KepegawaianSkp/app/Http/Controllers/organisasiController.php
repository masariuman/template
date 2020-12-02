<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Organisasi;

class organisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keanggotaan_organisasi = Organisasi::where('active', '1')->get();

        return view('keanggotaan_organisasi', compact('keanggotaan_organisasi'));
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

        $keanggotaan_organisasi = Organisasi::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'tahun_organisasi' => $request->tahun_organisasi,
            'nama_organisasi' => $request->nama_organisasi,
            'kedudukan' => $request->kedudukan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'nomor_sk' => $request->nomor_sk,
            'jabatan_pembuat_sk' => $request->jabatan_pembuat_sk,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data keanggotaan organisasi berhasil ditambahkan');

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

        $keanggotaan_organisasi = Organisasi::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'tahun_organisasi' => $request->tahun_organisasi,
            'nama_organisasi' => $request->nama_organisasi,
            'kedudukan' => $request->kedudukan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'nomor_sk' => $request->nomor_sk,
            'jabatan_pembuat_sk' => $request->jabatan_pembuat_sk,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data keanggotaan organisasi berhasil diubah');

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
        $keanggotaan_organisasi = Organisasi::where('id', $id)->delete();
        
        \Session::flash('Berhasil', 'Data keanggotaan organisasi berhasil dihapus');

        return back();
    }
}
