<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Hukuman;

class hukumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hukum_disiplin = Hukuman::where('active', '1')->get();

        return view('hukum_disiplin', compact('hukum_disiplin'));
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

        $hukum_disiplin = Hukuman::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'kode_hukuman' => $request->kode_hukuman,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'tmt_berlaku' => $request->tmt_berlaku,
            'pejabat_pembuat_sk' => $request->pejabat_pembuat_sk,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data hukuman disiplin berhasil ditambahkan');

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

        $hukum_disiplin = Hukuman::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'kode_hukuman' => $request->kode_hukuman,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'tmt_berlaku' => $request->tmt_berlaku,
            'pejabat_pembuat_sk' => $request->pejabat_pembuat_sk,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data hukuman disiplin berhasil diubah');

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
        $hukum_disiplin = Hukuman::where('id', $id)->delete();
        
        \Session::flash('Berhasil', 'Data hukuman disiplin berhasil dihapus');

        return back();
    }
}
