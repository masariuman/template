<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use Illuminate\Support\Facades\Session;

class periodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['periode'] = Periode::all();
        return view('admin/periode/index',$data);
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
        //
        Periode::create([
            'tahun' => $request->tahun,
            'periode' => $request->periode
        ]);
        $pesan = 'Periode <b>'.$request->tahun.' '.$request->periode.'</b> berhasil dibuat.';

        Session::flash('Berhasil', $pesan);

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
        //
        $data = Periode::findOrFail($id);
        $data->update([
            'tahun' => $request->tahun,
            'periode' => $request->periode
        ]);
        $pesan = 'Nama Periode berhasil diubah.';

        Session::flash('Berhasil', $pesan);

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
        //
    }
}
