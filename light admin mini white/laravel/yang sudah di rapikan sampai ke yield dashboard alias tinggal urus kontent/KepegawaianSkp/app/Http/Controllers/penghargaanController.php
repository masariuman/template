<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Penghargaan;

class penghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanda_jasa_penghargaan = Penghargaan::where('active', '1')->get();

        return view('tanda_jasa-penghargaan', compact('tanda_jasa_penghargaan'));
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

        $tanda_jasa_penghargaan = Penghargaan::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_penghargaan' => $request->nama_penghargaan,
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'nomor' => $request->nomor,
            'pemberi' => $request->pemberi,
            'jabatan_pemberi' => $request->jabatan_pemberi,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data tanda jasa / penghargaan berhasil ditambahkan');

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

        $tanda_jasa_penghargaan = Penghargaan::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_penghargaan' => $request->nama_penghargaan,
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'nomor' => $request->nomor,
            'pemberi' => $request->pemberi,
            'jabatan_pemberi' => $request->jabatan_pemberi,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data tanda jasa / penghargaan berhasil diubah');

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
        $tanda_jasa_penghargaan = Penghargaan::where('id', $id)->delete();
   
        \Session::flash('Berhasil', 'Data tanda jasa / penghargaan berhasil dihapus');

        return back();    
    }
}
