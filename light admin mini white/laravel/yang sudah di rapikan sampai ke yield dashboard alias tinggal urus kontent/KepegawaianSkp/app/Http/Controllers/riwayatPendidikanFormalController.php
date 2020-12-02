<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PendidikanFormal;
use App\Pegawai;

class riwayatPendidikanFormalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayat_pendidikan_formal = PendidikanFormal::where('active', '1')->get();

        // return $pendidikan_formal;

        return view('riwayat_pendidikan_formal', compact('riwayat_pendidikan_formal'));
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

        $pegawai_id = Pegawai::where('id', Auth()->user()->id)->first();

        $riwayat_pendidikan_formal = PendidikanFormal::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'nama_sekolah' => $request->nama_sekolah,
            'jurusan_prodi' => $request->jurusan_prodi,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
            'tempat_belajar' => $request->tempat_belajar,
            'lokasi' => $request->lokasi,
            'nomor_ijazah' => $request->nomor_ijazah,
            'active' => $request->input('active', 1),
        ]);

        // dd($pendidikan_formal);

        \Session::flash('Berhasil', 'Data riwayat pendidikan formal berhasil ditambahkan');

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

        $riwayat_pendidikan_formal = PendidikanFormal::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'tingkat_pendidikan' => $request->tingkat_pendidikan,
            'nama_sekolah' => $request->nama_sekolah,
            'jurusan_prodi' => $request->jurusan_prodi,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_lulus' => $request->tahun_lulus,
            'tempat_belajar' => $request->tempat_belajar,
            'lokasi' => $request->lokasi,
            'nomor_ijazah' => $request->nomor_ijazah,
            'active' => $request->input('active', 1),
        ]);

        // dd($pendidikan_formal);

        \Session::flash('Berhasil', 'Data riwayat pendidikan formal berhasil diubah');

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
        $riwayat_pendidikan_formal = PendidikanFormal::where('id', $id)->delete();

        \Session::flash('Berhasil', 'Data riwayat pendidikan formal berhasil dihapus');

        return back();
    }
}
