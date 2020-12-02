<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruangan;
use Illuminate\Support\Facades\Session;

class adminRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['ruangan'] = Ruangan::where('active','1')->orderBy('id','DESC')->get();
        return view('admin/ruangan/index',$data);
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
        Ruangan::create([
            'ruangan' => $request->ruangan
        ]);
        $pesan = 'Ruangan <b>'.$request->ruangan.'</b> berhasil dibuat.';

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
        $data = Ruangan::findOrFail($id);
        $data->update([
            'ruangan' => $request->ruangan
        ]);
        $pesan = 'Nama Ruangan berhasil diubah.';

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
        $data = Ruangan::findOrFail($id);
        $data->update([
            'active' => "0"
        ]);
        $pesan = 'Ruangan berhasil dihapus.';

        Session::flash('Berhasil', $pesan);

        return back();
    }
}
