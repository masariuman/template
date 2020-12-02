<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Pegawai;
use Illuminate\Support\Carbon;

class adminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //setting
        // $data['setting'] = Setting::findOrFail(1);
        // $terakhir_isi_skp = New Carbon($data['setting']['terakhir_isi_skp']);
        // $data['setting']['terakhir_isi_skp'] = $terakhir_isi_skp->translatedFormat('d F Y');

        // //skp str sikp rkk
        // $data['pegawai'] = Pegawai::where('active','1')->orderBy('id','DESC')->get();
        // $data['spk'] = [];
        // $data['sikp'] = [];
        // $data['str'] = [];
        // $data['rkk'] = [];
        // foreach ($data['pegawai'] as $key => $value) {
        //     $masa_str = date("Y-m-d", strtotime($value->masa_str));
        //     $masa_str = date_create($masa_str);
        //     $diff=date_diff(Carbon::now(),$masa_str)->format('%a');
        //     if($diff < 366){
        //         $data['str'][] = $value;
        //     }
        //     $masa_sikp = date("Y-m-d", strtotime($value->masa_sikp));
        //     $masa_sikp = date_create($masa_sikp);
        //     $diff=date_diff(Carbon::now(),$masa_sikp)->format('%a');
        //     if($diff < 366){
        //         $data['sikp'][] = $value;
        //     }
        //     $masa_spk = date("Y-m-d", strtotime($value->masa_spk));
        //     $masa_spk = date_create($masa_spk);
        //     $diff=date_diff(Carbon::now(),$masa_spk)->format('%a');
        //     if($diff < 366){
        //         $data['spk'][] = $value;
        //     }
        //     $masa_rkk = date("Y-m-d", strtotime($value->masa_rkk));
        //     $masa_rkk = date_create($masa_rkk);
        //     $diff=date_diff(Carbon::now(),$masa_rkk)->format('%a');
        //     if($diff < 366){
        //         $data['rkk'][] = $value;
        //     }
        // }
        // $data['count_str'] = count($data['str']);
        // $data['count_sikp'] = count($data['sikp']);
        // $data['count_spk'] = count($data['spk']);
        // $data['count_rkk'] = count($data['rkk']);

        return view('admin.content.dashboard.index');
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
