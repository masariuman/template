<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Anak;

class anakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anak = Anak::where('active', '1')->get();
        return view('anak', compact('anak'));
    }

    public function getTable()
    {

        $anak = Anak::where('active', '1')->get();
        return DataTables::of($anak)
        ->addColumn('aksi', function ($anak) {
            '<button class="mb-2 mr-2 btn btn-light" data-toggle="modal" data-target="#exampleModalLargeDetail-{{$anaks->id}}"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use address-card"></i> Lihat
            </button>||&nbsp;
            <button class="mb-2 mr-2 btn btn-light" data-toggle="modal" data-target="#exampleModalLargeUbah-{{$anaks->id}}"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use edit"></i> Ubah
            </button>||&nbsp;
            <button class="mb-2 mr-2 btn btn-light" data-toggle="modal" data-target=".bd-example-modal-sm-delete-{{$anaks->id}}"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use trash"></i> Hapus
            </button>||&nbsp';
        })
        ->addIndexColumn()
        ->rawColumns('aksi')
        ->make(true);


                   



    //     $va = Va::where('status_inquiry',1)->join('users', 'users.id', '=', 'va.user_id')->select('va.*', 'users.name')->get();

    //     return DataTables::of($va)

    //         ->addColumn('option', function ($anak) {
    //             return '<button class="mb-2 mr-2 btn btn-success" data-toggle="modal" data-target=".bd-example-modal-sm-iquiry-'. $va->id .'"> <i class="fa fa-search" aria-hidden="true" title="Copy to use bullhorn"></i> Cek Status
    //             </button>||&nbsp;
    //             <button class="mb-2 mr-2 btn btn-info" data-toggle="modal" data-target="#exampleModalLongDetail-'. $va->id .'"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use address-card"></i> Detail
    //             </button>||&nbsp;
    //             <button class="mb-2 mr-2 btn btn-alternate" data-toggle="modal" data-target="#exampleModalLongEdit-'. $va->id .'"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use edit"></i> Edit
    //             </button>||&nbsp;
    //             <button class="mb-2 mr-2 btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-sm-delete-'. $va->id .'"> <i class="fa fa-fw" aria-hidden="true" title="Copy to use trash"></i> Delete
    //             </button>';
    //         })
    //      ->addIndexColumn()

    //      ->addColumn('status', function ($va) {
    //         return '<div class="mb-2 mr-2 badge badge-pill badge-info">Pending</div>';
    //     })
    //  ->addIndexColumn()
    //  ->rawColumns(['status', 'option'])

    //     ->make(true);

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

        $anak = Anak::create([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_anak' => $request->status_anak,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data anak berhasil ditambah');

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

        $anak = Anak::where('id', $id)->update([
            'tahun' => $request->input('tahun', 2020),
            'pegawai_id' => $pegawai_id->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_anak' => $request->status_anak,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'active' => $request->input('active', 1),
        ]);

        \Session::flash('Berhasil', 'Data anak berhasil diubah');

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
        $anak = Anak::where('id', $id)->delete();
        
        \Session::flash('Berhasil', 'Data anak berhasil dihapus');

        return back();

    }
}
