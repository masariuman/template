<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Seminar;


class seminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seminar_lokakarya_simposium = Seminar::where('active', '1')->get();

        return view('seminar-lokakarya-simposium', compact('seminar_lokakarya_simposium'));
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

        $seminar_lokakarya_simposium = Seminar::insert([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi' => $request->lokasi,
            'tempat_kegiatan' => $request->tempat_kegiatan,
            'penyelenggara' => $request->penyelenggara,
            'tahun_seminar' => $request->tahun_seminar,
            'kedudukan_dalam_seminar' => $request->kedudukan_dalam_seminar,
            'active' => $request->input('active', 1),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \Session::flash('Berhasil', 'Data seminar / lokakarya / simposium berhasil ditambahkan');

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

        $seminar_lokakarya_simposium = Seminar::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'lokasi' => $request->lokasi,
            'tempat_kegiatan' => $request->tempat_kegiatan,
            'penyelenggara' => $request->penyelenggara,
            'tahun_seminar' => $request->tahun_seminar,
            'kedudukan_dalam_seminar' => $request->kedudukan_dalam_seminar,
            'active' => $request->input('active', 1),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        \Session::flash('Berhasil', 'Data seminar / lokakarya / simposium  berhasil diubah');

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
        $seminar_lokakarya_simposium = Seminar::where('id', $id)->delete();

        \Session::flash('Berhasil', 'Data seminar / lokakarya / simposium  berhasil dihapus');

        return back();
    }
}
