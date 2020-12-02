<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\DiklatTeknis;

class riwayatDiklatTeknisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayat_diklat_teknis = DiklatTeknis::where('active', '1')->get(); 
        return view('riwayat_diklat_teknis', compact('riwayat_diklat_teknis'));
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

        $riwayat_diklat_teknis = DiklatTeknis::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_diklat' => $request->nama_diklat,
            'tempat_belajar' => $request->tempat_belajar,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_jam' => $request->jumlah_jam,
            'penyelenggara' => $request->lokasi,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data diklat teknis berhasil ditambahkan');

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

        $riwayat_diklat_teknis = DiklatTeknis::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_diklat' => $request->nama_diklat,
            'tempat_belajar' => $request->tempat_belajar,
            'lokasi' => $request->lokasi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_jam' => $request->jumlah_jam,
            'penyelenggara' => $request->lokasi,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data diklat Teknis berhasil diubah');

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
        $riwayat_diklat_teknis = DiklatTeknis::where('id', $id)->delete();

        \Session::flash('Berhasil', 'Data diklat Teknis berhasil dihapus');

        return back();
    }
}
