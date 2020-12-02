<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\IstriSuami;

class istriSuamiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai_id = Pegawai::where('id', Auth()->user()->id)->first();

        $istri_suami = IstriSuami::where('active', '1')->get();

        return view('istri-suami', compact(['istri_suami', 'pegawai_id']));
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

        $istri_suami = IstriSuami::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama' => $request->nama,
            'nomor_karis_karsu' => $request->nomor_karis_karsu,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_nikah' => $request->tanggal_nikah,
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'status_suami_istri' => $request->status_suami_istri,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data istri suami berhasil ditambahkan');

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

        $istri_suami = IstriSuami::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama' => $request->nama,
            'nomor_karis_karsu' => $request->nomor_karis_karsu,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_nikah' => $request->tanggal_nikah,
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'status_suami_istri' => $request->status_suami_istri,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data istri suami berhasil diubah');

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
        $istri_suami = IstriSuami::where('id', $id)->delete();

        \Session::flash('Berhasil', 'Data istri suami berhasil dihapus');

        return back();
    }
}
