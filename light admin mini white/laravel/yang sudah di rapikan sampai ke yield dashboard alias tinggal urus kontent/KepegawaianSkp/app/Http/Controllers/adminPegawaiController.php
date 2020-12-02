<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\User;
use App\PendidikanFormal;
use App\DiklatFungsional;
use App\DiklatPenjenjangan;
use App\DiklatTeknis;
use App\Kepangkatan;
use App\JabatanStruktural;
use App\JabatanFungsional;
use App\PekerjaanJabatan;
use App\IstriSuami;
use App\Anak;
use App\Seminar;
use App\Penghargaan;
Use App\Hukuman;
use App\Organisasi;
use App\KeluargaKandung;
use App\KeluargaIstriSuami;
use App\Ruangan;
use App\Periode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class adminPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['ruangan'] = Ruangan::where('active','1')->get();
        $data['pegawai'] = Pegawai::where('active','1')->orderBy('id','DESC')->get();
        return view('admin/pegawai/index',$data);
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
        $spasi = '';
        $spasi2 = '';
        if ($request->gelar_depan != null) {
            $spasi = '. ';
        }
        if($request->gelar_belakang !=null) {
            $spasi2 = ', ';
        }
        $nama = $request->gelar_depan.$spasi.$request->nama.$spasi2.$request->gelar_belakang;
        $lahir = explode("-",$request->tanggal_lahir);
        $lahir = $lahir[2].$lahir[1].$lahir[0];
        $password = Hash::make($lahir);
        User::create([
            'name' => $nama,
            'email' => $request->email,
            'password' => $password
        ]);
        $newuser = User::where('email',$request->email)->first();
        Pegawai::create([
            'nama_pegawai' => $request->nama,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang'=> $request->gelar_belakang,
            'tanggal_lahir' => $request->tanggal_lahir,
            'user_id' => $newuser->id,
            'ruangan_id' => $request->ruangan
        ]);

        $pesan = 'User baru telah dibuat. Silahkan memberitahu pegawai untuk login dengan email <b>'.$newuser->email.'</b> dan dengan password tanggal lahir(<b>'.$lahir.'</b>) untuk melengkapi data dasar.';

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
        //dasar
        $data['ruangan'] = Ruangan::where('active','1')->get();
        $data['pegawai'] = Pegawai::findOrFail($id);
        $convertTanggal = New Carbon($data['pegawai']['masa_rkk']);
        $data['pegawai']['masa_rkk'] = $convertTanggal->translatedFormat('d F Y');
        // $data['pegawai']['masa_rkk'] = date("d F Y", strtotime($data['pegawai']['masa_rkk']));
        $convertTanggal = New Carbon($data['pegawai']['masa_spk']);
        $data['pegawai']['masa_spk'] = $convertTanggal->translatedFormat('d F Y');
        // $data['pegawai']['masa_spk'] = date("d F Y", strtotime($data['pegawai']['masa_spk']));
        $convertTanggal = New Carbon($data['pegawai']['masa_sikp']);
        $data['pegawai']['masa_sikp'] = $convertTanggal->translatedFormat('d F Y');
        // $data['pegawai']['masa_sikp'] = date("d F Y", strtotime($data['pegawai']['masa_sikp']));
        $convertTanggal = New Carbon($data['pegawai']['masa_str']);
        $data['pegawai']['masa_str'] = $convertTanggal->translatedFormat('d F Y');
        // $data['pegawai']['masa_str'] = date("d F Y", strtotime($data['pegawai']['masa_str']));
        $convertTanggal = New Carbon($data['pegawai']['tmt_golongan']);
        $data['pegawai']['tmt_golongan'] = $convertTanggal->translatedFormat('d F Y');
        // $data['pegawai']['tmt_golongan'] = date("d F Y", strtotime($data['pegawai']['tmt_golongan']));
        $convertTanggal = New Carbon($data['pegawai']['tmt_cpns']);
        $data['pegawai']['tmt_cpns'] = $convertTanggal->translatedFormat('d F Y');
        // $data['pegawai']['tmt_cpns'] = date("d F Y", strtotime($data['pegawai']['tmt_cpns']));
        $convertTanggal = New Carbon($data['pegawai']['tanggal_lahir']);
        $data['pegawai']['tanggal_lahir'] = $convertTanggal->translatedFormat('d F Y');
        // $data['pegawai']['tanggal_lahir'] = date("d F Y", strtotime($data['pegawai']['tanggal_lahir']));
        if ($data['pegawai']['jenis_kelamin'] === "W") {
            $data['pegawai']['jenis_kelamin'] = "Perempuan";
        } else {
            $data['pegawai']['jenis_kelamin'] = "Laki-Laki";
        }
        if ($data['pegawai']['status_keluarga'] === "K"){
            $data['pegawai']['status_keluarga'] = "Sudah Menikah";
        } else if ($data['pegawai']['status_keluarga'] === "B"){
            $data['pegawai']['status_keluarga'] = "Belum Menikah";
        } else if ($data['pegawai']['status_keluarga'] === "D"){
            $data['pegawai']['status_keluarga'] = "Duda";
        } else {
            $data['pegawai']['status_keluarga'] = "Janda";
        }
        if ($data['pegawai']['agama'] === "1"){
            $data['pegawai']['agama'] = "Islam";
        } else if ($data['pegawai']['agama'] === "2"){
            $data['pegawai']['agama'] = "Katholik";
        } else if ($data['pegawai']['agama'] === "3"){
            $data['pegawai']['agama'] = "Protestan";
        } else if ($data['pegawai']['agama'] === "4"){
            $data['pegawai']['agama'] = "Hindu";
        } else if ($data['pegawai']['agama'] === "5"){
            $data['pegawai']['agama'] = "Budha";
        } else {
            $data['pegawai']['agama'] = "Protestan";
        }
        if ($data['pegawai']['status_kepegawaian'] === "1"){
            $data['pegawai']['status_kepegawaian'] = "CPNS";
        } else if ($data['pegawai']['status_kepegawaian'] === "2"){
            $data['pegawai']['status_kepegawaian'] = "PNS";
        } else if ($data['pegawai']['status_kepegawaian'] === "3"){
            $data['pegawai']['status_kepegawaian'] = "PNS DPK dari DEP.LAIN";
        } else {
            $data['pegawai']['status_kepegawaian'] = "PNS DPK ke DEP.LAIN";
        }
        if ($data['pegawai']['taspen'] === "1"){
            $data['pegawai']['taspen'] = "Sudah";
        }else {
            $data['pegawai']['taspen'] = "Belum";
        }

        //riwayat pendidikan formal
        $data['pendidikan_formal'] = PendidikanFormal::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['pendidikan_formal'] as $key => $value) {
            if ($value['tingkat_pendidikan'] === "01") {
                $value['tingkat_pendidikan'] = "S3 (Setara)";
            } else if ($value['tingkat_pendidikan'] === "02") {
                $value['tingkat_pendidikan'] = "S2 (Setara)";
            } else if ($value['tingkat_pendidikan'] === "03") {
                $value['tingkat_pendidikan'] = "S1 (Setara)";
            } else if ($value['tingkat_pendidikan'] === "04") {
                $value['tingkat_pendidikan'] = "D4";
            } else if ($value['tingkat_pendidikan'] === "05") {
                $value['tingkat_pendidikan'] = "SM";
            } else if ($value['tingkat_pendidikan'] === "06") {
                $value['tingkat_pendidikan'] = "D3";
            } else if ($value['tingkat_pendidikan'] === "07") {
                $value['tingkat_pendidikan'] = "D2";
            } else if ($value['tingkat_pendidikan'] === "08") {
                $value['tingkat_pendidikan'] = "D1";
            } else if ($value['tingkat_pendidikan'] === "09") {
                $value['tingkat_pendidikan'] = "SLTA";
            } else if ($value['tingkat_pendidikan'] === "10") {
                $value['tingkat_pendidikan'] = "SLTP";
            } else {
                $value['tingkat_pendidikan'] = "SD";
            }
            if ($value['tempat_belajar'] === "1") {
                $value['tempat_belajar'] = "Dalam Negeri";
            } else {
                $value['tempat_belajar'] = "Luar Negeri";
            }
        }


        //riwayat diklat fungsional
        $data['diklat_fungsional'] = DiklatFungsional::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['diklat_fungsional'] as $key => $value) {
            if ($value['tempat_belajar'] === "1") {
                $value['tempat_belajar'] = "Dalam Negeri";
            } else {
                $value['tempat_belajar'] = "Luar Negeri";
            }
            $convertTanggal = New Carbon($value['tanggal_mulai']);
            $value['tanggal_mulai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_mulai'] = date("d F Y", strtotime($value['tanggal_mulai']));
            $convertTanggal = New Carbon($value['tanggal_selesai']);
            $value['tanggal_selesai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_selesai'] = date("d F Y", strtotime($value['tanggal_selesai']));
        }

        //riwayat diklat perjenjangan
        $data['diklat_penjenjangan'] = DiklatPenjenjangan::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['diklat_penjenjangan'] as $key => $value) {
            if ($value['jenis_diklat'] === "1") {
                $value['jenis_diklat'] = "Diklatpim Tk I";
            } else if ($value['jenis_diklat'] === "2"){
                $value['jenis_diklat'] = "Diklatpim Tk II";
            } else if ($value['jenis_diklat'] === "3"){
                $value['jenis_diklat'] = "Diklatpim Tk III";
            } else if ($value['jenis_diklat'] === "4"){
                $value['jenis_diklat'] = "Diklatpim Tk IV";
            } else {
                $value['jenis_diklat'] = "Diklat Lain Yang Setara";
            }
            $convertTanggal = New Carbon($value['tanggal_mulai']);
            $value['tanggal_mulai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_mulai'] = date("d F Y", strtotime($value['tanggal_mulai']));
            $convertTanggal = New Carbon($value['tanggal_selesai']);
            $value['tanggal_selesai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_selesai'] = date("d F Y", strtotime($value['tanggal_selesai']));
        }

        //riwayat diklat teknis
        $data['diklat_teknis'] = DiklatTeknis::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['diklat_teknis'] as $key => $value) {
            if ($value['tempat_belajar'] === "1") {
                $value['tempat_belajar'] = "Dalam Negeri";
            } else {
                $value['tempat_belajar'] = "Luar Negeri";
            }
            $convertTanggal = New Carbon($value['tanggal_mulai']);
            $value['tanggal_mulai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_mulai'] = date("d F Y", strtotime($value['tanggal_mulai']));
            $convertTanggal = New Carbon($value['tanggal_selesai']);
            $value['tanggal_selesai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_selesai'] = date("d F Y", strtotime($value['tanggal_selesai']));
        }

        //riwayat kepangkatan
        $data['kepangkatan'] = Kepangkatan::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['kepangkatan'] as $key => $value) {
            $convertTanggal = New Carbon($value['tmt_golongan']);
            $value['tmt_golongan'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tmt_golongan'] = date("d F Y", strtotime($value['tmt_golongan']));
            $convertTanggal = New Carbon($value['tanggal_sk']);
            $value['tanggal_sk'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_sk'] = date("d F Y", strtotime($value['tanggal_sk']));
        }

        //riwayat jabatan struktural
        $data['jabatan_struktural'] = JabatanStruktural::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['jabatan_struktural'] as $key => $value) {
            $convertTanggal = New Carbon($value['tmt_jabatan']);
            $value['tmt_jabatan'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tmt_jabatan'] = date("d F Y", strtotime($value['tmt_jabatan']));
            $convertTanggal = New Carbon($value['tanggal_sk']);
            $value['tanggal_sk'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_sk'] = date("d F Y", strtotime($value['tanggal_sk']));
        }

        //riwayat jabatan fungsional
        $data['jabatan_fungsional'] = JabatanFungsional::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['jabatan_fungsional'] as $key => $value) {
            $convertTanggal = New Carbon($value['tmt_jabatan']);
            $value['tmt_jabatan'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tmt_jabatan'] = date("d F Y", strtotime($value['tmt_jabatan']));
            $convertTanggal = New Carbon($value['tanggal_sk']);
            $value['tanggal_sk'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_sk'] = date("d F Y", strtotime($value['tanggal_sk']));
        }

        //pekerjaan jabatan
        $data['pekerjaan_jabatan'] = PekerjaanJabatan::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['pekerjaan_jabatan'] as $key => $value) {
            $convertTanggal = New Carbon($value['tmt_jabatan']);
            $value['tmt_jabatan'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tmt_jabatan'] = date("d F Y", strtotime($value['tmt_jabatan']));
            $convertTanggal = New Carbon($value['tanggal_sk']);
            $value['tanggal_sk'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_sk'] = date("d F Y", strtotime($value['tanggal_sk']));
        }

        //istri suami
        $data['istri_suami'] = IstriSuami::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['istri_suami'] as $key => $value) {
            $convertTanggal = New Carbon($value['tanggal_lahir']);
            $value['tanggal_lahir'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_lahir'] = date("d F Y", strtotime($value['tanggal_lahir']));
            $convertTanggal = New Carbon($value['tanggal_nikah']);
            $value['tanggal_nikah'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_nikah'] = date("d F Y", strtotime($value['tanggal_nikah']));
            if ($value['tingkat_pendidikan'] === "01") {
                $value['tingkat_pendidikan'] = "S3 (Setara)";
            } else if ($value['tingkat_pendidikan'] === "02") {
                $value['tingkat_pendidikan'] = "S2 (Setara)";
            } else if ($value['tingkat_pendidikan'] === "03") {
                $value['tingkat_pendidikan'] = "S1 (Setara)";
            } else if ($value['tingkat_pendidikan'] === "04") {
                $value['tingkat_pendidikan'] = "D4";
            } else if ($value['tingkat_pendidikan'] === "05") {
                $value['tingkat_pendidikan'] = "SM";
            } else if ($value['tingkat_pendidikan'] === "06") {
                $value['tingkat_pendidikan'] = "D3";
            } else if ($value['tingkat_pendidikan'] === "07") {
                $value['tingkat_pendidikan'] = "D2";
            } else if ($value['tingkat_pendidikan'] === "08") {
                $value['tingkat_pendidikan'] = "D1";
            } else if ($value['tingkat_pendidikan'] === "09") {
                $value['tingkat_pendidikan'] = "SLTA";
            } else if ($value['tingkat_pendidikan'] === "10") {
                $value['tingkat_pendidikan'] = "SLTP";
            } else {
                $value['tingkat_pendidikan'] = "SD";
            }
            if ($value['status_suami_istri'] === "1") {
                if ($data['pegawai']['jenis_kelamin'] === "Perempuan") {
                    $value['status_suami_istri'] = "Suami Saat ini";
                } else {
                    $value['status_suami_istri'] = "Istri Saat ini";
                }
            } else if ($value['status_suami_istri'] === "2") {
                $value['status_suami_istri'] = "Telah Meninggal Dunia";
            } else {
                $value['status_suami_istri'] = "Cerai";
            }
        }

        //anak
        $data['anak'] = Anak::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['anak'] as $key => $value) {
            if ($value['jenis_kelamin'] === "W") {
                $value['jenis_kelamin'] = "Perempuan";
            } else {
                $value['jenis_kelamin'] = "Laki-Laki";
            }
            $convertTanggal = New Carbon($value['tanggal_lahir']);
            $value['tanggal_lahir'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_lahir'] = date("d F Y", strtotime($value['tanggal_lahir']));
            if ($value['anak'] === "1") {
                $value['anak'] = "Anak Kandung";
            } else if ($value['anak'] === "2") {
                $value['anak'] = "Anak Tiri";
            } else {
                $value['anak'] = "Anak Angkat";
            }
            if ($value['pendidikan'] === "01") {
                $value['pendidikan'] = "S3 (Setara)";
            } else if ($value['pendidikan'] === "02") {
                $value['pendidikan'] = "S2 (Setara)";
            } else if ($value['pendidikan'] === "03") {
                $value['pendidikan'] = "S1 (Setara)";
            } else if ($value['pendidikan'] === "04") {
                $value['pendidikan'] = "D4";
            } else if ($value['pendidikan'] === "05") {
                $value['pendidikan'] = "SM";
            } else if ($value['pendidikan'] === "06") {
                $value['pendidikan'] = "D3";
            } else if ($value['pendidikan'] === "07") {
                $value['pendidikan'] = "D2";
            } else if ($value['pendidikan'] === "08") {
                $value['pendidikan'] = "D1";
            } else if ($value['pendidikan'] === "09") {
                $value['pendidikan'] = "SLTA";
            } else if ($value['pendidikan'] === "10") {
                $value['pendidikan'] = "SLTP";
            } else if ($value['pendidikan'] === "11") {
                $value['pendidikan'] = "SD";
            } else {
                $value['pendidikan'] = "Belum Sekolah";
            }
        }

        //seminar
        $data['seminar'] = Seminar::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['seminar'] as $key => $value) {
            if ($value['tempat_kegiatan'] === "1") {
                $value['tempat_kegiatan'] = "Dalam Negeri";
            } else {
                $value['tempat_kegiatan'] = "Luar Negeri";
            }
            if ($value['kedudukan_dalam_seminar'] === "1") {
                $value['kedudukan_dalam_seminar'] = "Peserta";
            } else if ($value['kedudukan_dalam_seminar'] === "2") {
                $value['kedudukan_dalam_seminar'] = "Moderator";
            } else if ($value['kedudukan_dalam_seminar'] === "3") {
                $value['kedudukan_dalam_seminar'] = "Pembahas";
            } else if ($value['kedudukan_dalam_seminar'] === "4") {
                $value['kedudukan_dalam_seminar'] = "Pembawa Makalah";
            } else {
                $value['kedudukan_dalam_seminar'] = "Panitia";
            }
        }

        //penghargaan
        $data['penghargaan'] = Penghargaan::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['penghargaan'] as $key => $value) {
            $convertTanggal = New Carbon($value['tanggal_perolehan']);
            $value['tanggal_perolehan'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_perolehan'] = date("d F Y", strtotime($value['tanggal_perolehan']));
        }

        //hukuman
        $data['hukuman'] = Hukuman::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['hukuman'] as $key => $value) {
            if ($value['kode_hukuman'] === "11") {
                $value['kode_hukuman'] = "11 (Hukuman Ringan Teguran Lisan)";
            } else if ($value['kode_hukuman'] === "12") {
                $value['kode_hukuman'] = "12 (Hukuman Ringan Teguran Tertulis)";
            } else if ($value['kode_hukuman'] === "13") {
                $value['kode_hukuman'] = "13 (Hukuman Ringan Melalui Pernyataan Tidak Puas Secara Tertulis)";
            } else if ($value['kode_hukuman'] === "21") {
                $value['kode_hukuman'] = "21 (Hukuman Sedang Penundaan Kenaikan Gaji Berkala Paling Lama 1 Tahun)";
            } else if ($value['kode_hukuman'] === "22") {
                $value['kode_hukuman'] = "22 (Hukuman Sedang Penurunan Gaji Sebesar 1x Kenaikan Gaji Berkala Paling Lama 1 Tahun)";
            } else if ($value['kode_hukuman'] === "23") {
                $value['kode_hukuman'] = "23 (Hukuman Sedang Penundaan Kenaikan Pangkat Paling Lama 1 Tahun)";
            } else if ($value['kode_hukuman'] === "31") {
                $value['kode_hukuman'] = "31 (Hukuman Berat Penurunan Pangkat Setingkat Lebih Rendah Paling Lama 1 Tahun)";
            } else {
                $value['kode_hukuman'] = "32 (Hukuman Berat Pembebasan Dari Jabatan)";
            }
            $convertTanggal = New Carbon($value['tanggal_sk']);
            $value['tanggal_sk'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_sk'] = date("d F Y", strtotime($value['tanggal_sk']));
            $convertTanggal = New Carbon($value['tmt_berlaku']);
            $value['tmt_berlaku'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tmt_berlaku'] = date("d F Y", strtotime($value['tmt_berlaku']));
        }

        //organisasi
        $data['organisasi'] = Organisasi::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['organisasi'] as $key => $value) {
            $convertTanggal = New Carbon($value['tanggal_mulai']);
            $value['tanggal_mulai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_mulai'] = date("d F Y", strtotime($value['tanggal_mulai']));
            $convertTanggal = New Carbon($value['tanggal_selesai']);
            $value['tanggal_selesai'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_selesai'] = date("d F Y", strtotime($value['tanggal_selesai']));
        }

        //keluarga kandung
        $data['keluarga_kandung'] = KeluargaKandung::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['keluarga_kandung'] as $key => $value) {
            if ($value['hubungan'] === "1") {
                $value['hubungan'] = "Ayah";
            } else if ($value['hubungan'] === "2") {
                $value['hubungan'] = "Ibu";
            } else if ($value['hubungan'] === "3") {
                $value['hubungan'] = "Kakak";
            } else {
                $value['hubungan'] = "Adik";
            }
            if ($value['jenis_kelamin'] === "P") {
                $value['jenis_kelamin'] = "Perempuan";
            } else {
                $value['jenis_kelamin'] = "Laki-Laki";
            }
            $convertTanggal = New Carbon($value['tanggal_lahir']);
            $value['tanggal_lahir'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_lahir'] = date("d F Y", strtotime($value['tanggal_lahir']));
            if ($value['kondisi'] === "1") {
                $value['kondisi'] = "Masih Hidup";
            } else {
                $value['kondisi'] = "Almarhum";
            }
        }

        //keluarga istri suami
        $data['keluarga_istri_suami'] = KeluargaIstriSuami::where('pegawai_id',$id)->where('active','1')->orderBy('id','DESC')->get();
        foreach ($data['keluarga_istri_suami'] as $key => $value) {
            if ($value['hubungan'] === "1") {
                $value['hubungan'] = "Ayah";
            } else if ($value['hubungan'] === "2") {
                $value['hubungan'] = "Ibu";
            } else if ($value['hubungan'] === "3") {
                $value['hubungan'] = "Kakak";
            } else {
                $value['hubungan'] = "Adik";
            }
            if ($value['jenis_kelamin'] === "P") {
                $value['jenis_kelamin'] = "Perempuan";
            } else {
                $value['jenis_kelamin'] = "Laki-Laki";
            }
            $convertTanggal = New Carbon($value['tanggal_lahir']);
            $value['tanggal_lahir'] = $convertTanggal->translatedFormat('d F Y');
            // $value['tanggal_lahir'] = date("d F Y", strtotime($value['tanggal_lahir']));
            if ($value['kondisi'] === "1") {
                $value['kondisi'] = "Masih Hidup";
            } else {
                $value['kondisi'] = "Almarhum";
            }
        }

        return view('admin/pegawai/show',$data);
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

    public function skp($id){
        //variable dasar
        $data['ruangan'] = Ruangan::where('active','1')->get();
        $data['pegawai'] = Pegawai::findOrFail($id);
        $data['periode'] = Periode::orderBy('id','DESC')->first();
        $data['tahun'] = Periode::pluck('tahun')->unique();
        $data['noFormSkp'] = 0;
        $data['noPengukuranSkp'] = 0;
        $data['skp'] = $data['pegawai']
                        ->skp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode)
                        ->first();
        $data['formSkp'] = $data['pegawai']
                        ->formSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp_kegiatan_tugas_tambahan'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('kategori_pengukuran','Kegiatan Tugas Tambahan')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp_kreativitas'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('kategori_pengukuran','Kreativitas')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp_tugas_tambahan'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('kategori_pengukuran','Tugas Tambahan')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['penilaianSkp'] = $data['pegawai']
                        ->penilaianSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode)
                        ->first();
        $data['perilakuKerjaSkp'] = $data['pegawai']
                        ->perilakuKerjaSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode)
                        ->first();
        //untuk cek data tiap table tidak kosong atau tidak null
        $data['countFormSkp'] = count($data['formSkp']);
        $data['countPengukuranSkp'] = count($data['pengukuranSkp']);
        $data['countPengukuranSkp_kegiatan_tugas_tambahan'] = count($data['pengukuranSkp_kegiatan_tugas_tambahan']);
        $data['countPengukuranSkp_kreativitas'] = count($data['pengukuranSkp_kreativitas']);
        $data['countPengukuranSkp_tugas_tambahan'] = count($data['pengukuranSkp_tugas_tambahan']);
        // $data['countPenilaianSkp'] = count($data['penilaianSkp']);
        // $data['countPerilakuKerjaSkp'] = count($data['perilakuKerjaSkp']);
        $data['totalKegiatan'] = 0;
        $data['totalAkTarget'] = 0;
        $data['totalKuantTarget1'] = 0;
        $data['totalKuantTarget2'] = 0;
        $data['totalKualTarget'] = 0;
        $data['totalBiayaTarget'] = 0;
        $data['totalAkRealisasi'] = 0;
        $data['totalKuantRealisasi'] = 0;
        $data['totalKuantRealisasi2'] = 0;
        $data['totalKualRealisasi'] = 0;
        $data['totalBiayaRealisasi'] = 0;
        $data['totalPenghitungan'] = 0;
        $data['totalNilaiCapaianSkp'] = 0;
        $data['totalNilaiCapaianSkp2'] = 0;
        $data['totalNilaiCapaianSkp3'] = 0;
        $data['totalWaktuTarget'] = 0;
        $data['totalWaktuRealisasi'] = 0;
        $data['nilaiCapaianSkp1'] = 0;
        $data['nilaiCapaianSkp2'] = 0;
        //dari sini pengukuran skp
        if ($data['countPengukuranSkp'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }

                $data['totalKegiatan'] += $value->kegiatan_tugas_tambahan;
                $data['totalAkTarget'] += $value->ak_target;
                $data['totalKuantTarget1'] += $value->target_kuant_output_1;
                $data['totalKuantTarget2'] += $value->target_kuant_output_2;
                $data['totalKualTarget'] += $value->target_kual_mutu;
                $data['totalWaktuTarget'] += $value->target_waktu;
                $data['totalBiayaTarget'] += $value->target_biaya;
                $data['totalAkRealisasi'] += $value->ak_realisasi;
                $data['totalKuantRealisasi'] += $value->realisasi_kuant_output_1;
                $data['totalKuantRealisasi2'] += $value->realisasi_kuant_output_2;
                $data['totalKualRealisasi'] += $value->realisasi_kual_mutu;
                $data['totalWaktuRealisasi'] += $value->realisasi_waktu;
                $data['totalBiayaRealisasi'] += $value->realisasi_biaya;
                $data['totalPenghitungan'] += $value['penghitungan'];
                $data['totalNilaiCapaianSkp'] += $value['nilai_capaian_skp'];

                // ($data['nilaiCapaianSkp1'] / $data['nilaiCapaianSkp2']) +  +  ;
            }
        }
        if ($data['countPengukuranSkp_kegiatan_tugas_tambahan'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp_kegiatan_tugas_tambahan'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }

                if ($value['nilai_capaian_skp'] === null || $value['nilai_capaian_skp'] === "" || $value['nilai_capaian_skp'] === 0) {
                    //do nothing karena 0
                } else {
                    $data['nilaiCapaianSkp1'] += $value['nilai_capaian_skp'];
                }
                if ($value->target_kuant_output_1 === null || $value->target_kuant_output_1 === "" || $value->target_kuant_output_1 === 0) {
                    //do nothing karena 0
                } else {
                    $data['nilaiCapaianSkp2'] += 1;
                }

                // ($data['nilaiCapaianSkp1'] / $data['nilaiCapaianSkp2']) +  +  ;
            }
        }
        if ($data['countPengukuranSkp_kreativitas'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp_kreativitas'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }
                $data['totalNilaiCapaianSkp2'] += $value['nilai_capaian_skp'];
            }
        }
        if ($data['countPengukuranSkp_tugas_tambahan'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp_tugas_tambahan'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }
                $data['totalNilaiCapaianSkp3'] += $value['nilai_capaian_skp'];
            }
        }
        $data['nilaiCapaianSkpFinal1'] = ($data['nilaiCapaianSkp1'] / $data['nilaiCapaianSkp2']) + $data['totalNilaiCapaianSkp2'] + $data['totalNilaiCapaianSkp3'];
        if ($data['nilaiCapaianSkpFinal1'] <= 50) {
            $data['nilaiCapaianSkpFinal2'] = 'BURUK';
        } else {
            if ($data['nilaiCapaianSkpFinal1'] <= 75) {
                $data['nilaiCapaianSkpFinal2'] = 'CUKUP';
            } else {
                if ($data['nilaiCapaianSkpFinal1'] <= 90.99) {
                    $data['nilaiCapaianSkpFinal2'] = 'BAIK';
                } else {
                    $data['nilaiCapaianSkpFinal2'] = 'SANGAT BAIK';
                }
            }
        }
        //selesai urusan pengukuran
        //dari sini urusan perilaku kerja
        if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 50) {
            $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 60) {
                $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 75) {
                    $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 90.99) {
                        $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['integritas'] <= 50) {
            $data['perilakuKerjaSkpIntegritas'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['integritas'] <= 60) {
                $data['perilakuKerjaSkpIntegritas'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['integritas'] <= 75) {
                    $data['perilakuKerjaSkpIntegritas'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['integritas'] <= 90.99) {
                        $data['perilakuKerjaSkpIntegritas'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpIntegritas'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['komitmen'] <= 50) {
            $data['perilakuKerjaSkpKomitmen'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['komitmen'] <= 60) {
                $data['perilakuKerjaSkpKomitmen'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['komitmen'] <= 75) {
                    $data['perilakuKerjaSkpKomitmen'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['komitmen'] <= 90.99) {
                        $data['perilakuKerjaSkpKomitmen'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpKomitmen'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['disiplin'] <= 50) {
            $data['perilakuKerjaSkpDisiplin'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['disiplin'] <= 60) {
                $data['perilakuKerjaSkpDisiplin'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['disiplin'] <= 75) {
                    $data['perilakuKerjaSkpDisiplin'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['disiplin'] <= 90.99) {
                        $data['perilakuKerjaSkpDisiplin'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpDisiplin'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['kerjasama'] <= 50) {
            $data['perilakuKerjaSkpKerjasama'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['kerjasama'] <= 60) {
                $data['perilakuKerjaSkpKerjasama'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['kerjasama'] <= 75) {
                    $data['perilakuKerjaSkpKerjasama'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['kerjasama'] <= 90.99) {
                        $data['perilakuKerjaSkpKerjasama'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpKerjasama'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 50) {
            $data['perilakuKerjaSkpKepemimpinan'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 60) {
                $data['perilakuKerjaSkpKepemimpinan'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 75) {
                    $data['perilakuKerjaSkpKepemimpinan'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 90.99) {
                        $data['perilakuKerjaSkpKepemimpinan'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpKepemimpinan'] = "(Sangat Baik)";
                    }
                }
            }
        }
        $data['perilakuKerjaSkpJumlah'] = $data['perilakuKerjaSkp']['kepemimpinan']
            + $data['perilakuKerjaSkp']['kerjasama']
            + $data['perilakuKerjaSkp']['disiplin']
            + $data['perilakuKerjaSkp']['komitmen']
            + $data['perilakuKerjaSkp']['integritas']
            + $data['perilakuKerjaSkp']['orientasi_pelayanan'];
        if ($data['perilakuKerjaSkp']['kepemimpinan'] === null
            || $data['perilakuKerjaSkp']['kepemimpinan'] === 0
            || $data['perilakuKerjaSkp']['kepemimpinan'] === "") {
                $data['perilakuKerjaSkpRata'] = $data['perilakuKerjaSkpJumlah'] / 5;
        } else {
            $data['perilakuKerjaSkpRata'] = $data['perilakuKerjaSkpJumlah'] / 6;
        }
        if ($data['perilakuKerjaSkpRata'] <= 50) {
            $data['perilakuKerjaSkpRatarata'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkpRata'] <= 60) {
                $data['perilakuKerjaSkpRatarata'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkpRata'] <= 75) {
                    $data['perilakuKerjaSkpRatarata'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkpRata'] <= 90.99) {
                        $data['perilakuKerjaSkpRatarata'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpRatarata'] = "(Sangat Baik)";
                    }
                }
            }
        }
        //selesai urusan perilaku kerja
        //dari sini urusan penilaian kerja
        $data['penilaianSasaranKerjaPegawai'] = $data['nilaiCapaianSkpFinal1'] * 60 / 100;
        $data['penilaianNilaiPerilakuKerja'] = $data['perilakuKerjaSkpRata'] * 40 / 100;
        $data['penilaianNilaiPrestasiKerja'] =  $data['penilaianSasaranKerjaPegawai'] + $data['penilaianNilaiPerilakuKerja'];
        if ($data['penilaianNilaiPrestasiKerja'] <= 50) {
            $data['penilaianNilaiPrestasiKerja2'] = "(Buruk)";
        } else {
            if ($data['penilaianNilaiPrestasiKerja'] <= 60) {
                $data['penilaianNilaiPrestasiKerja2'] = "(Kurang)";
            } else {
                if ($data['penilaianNilaiPrestasiKerja'] <= 75) {
                    $data['penilaianNilaiPrestasiKerja2'] = "(Cukup)";
                } else {
                    if ($data['penilaianNilaiPrestasiKerja'] <= 90.99) {
                        $data['penilaianNilaiPrestasiKerja2'] = "(Baik)";
                    } else {
                        $data['penilaianNilaiPrestasiKerja2'] = "(Sangat Baik)";
                    }
                }
            }
        }
        $convertTanggal = New Carbon($data['penilaianSkp']['tanggal_keberatan_pegawai']);
        $data['penilaianSkp']['tanggal_keberatan_pegawai'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['tanggal_tanggapan_pejabat']);
        $data['penilaianSkp']['tanggal_tanggapan_pejabat'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['tanggal_keputusan_atasan_pejabat']);
        $data['penilaianSkp']['tanggal_keputusan_atasan_pejabat'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['dibuat_tanggal_pejabat_penilai']);
        $data['penilaianSkp']['dibuat_tanggal_pejabat_penilai'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['diterima_tanggal_pegawai']);
        $data['penilaianSkp']['diterima_tanggal_pegawai'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['diterima_tanggal_atasan_pejabat_penilai']);
        $data['penilaianSkp']['diterima_tanggal_atasan_pejabat_penilai'] = $convertTanggal->translatedFormat('d F Y');


        // dd($data['perilakuKerjaSkp']['orientasi_pelayanan']);
        return view('admin/pegawai/skp',$data);
    }

    public function skp_filter(Request $request, $id){
        $data['ruangan'] = Ruangan::where('active','1')->get();
        $data['pegawai'] = Pegawai::findOrFail($id);
        if ($request->kategori === 'semester1') {
            $periodeSemester = 'Semester 1';
        } else if ($request->kategori === 'semester2'){
            $periodeSemester = 'Semester 2';
        } else {
            $periodeSemester = 'Setahun';
        }
        $data['periode'] = Periode::where('tahun',$request->tahun)->where('periode',$periodeSemester)->first();
        $data['tahun'] = Periode::pluck('tahun')->unique();
        $data['noFormSkp'] = 0;
        $data['noPengukuranSkp'] = 0;
        $data['skp'] = $data['pegawai']
                        ->skp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode)
                        ->first();
        $data['formSkp'] = $data['pegawai']
                        ->formSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp_kegiatan_tugas_tambahan'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('kategori_pengukuran','Kegiatan Tugas Tambahan')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp_kreativitas'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('kategori_pengukuran','Kreativitas')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['pengukuranSkp_tugas_tambahan'] = $data['pegawai']
                        ->pengukuranSkp
                        ->where('active','1')
                        ->where('kategori_pengukuran','Tugas Tambahan')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode);
        $data['penilaianSkp'] = $data['pegawai']
                        ->penilaianSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode)
                        ->first();
        $data['perilakuKerjaSkp'] = $data['pegawai']
                        ->perilakuKerjaSkp
                        ->where('active','1')
                        ->where('tahun',$data['periode']->tahun)
                        ->where('kategori',$data['periode']->periode)
                        ->first();
        $data['countFormSkp'] = count($data['formSkp']);
        $data['countPengukuranSkp'] = count($data['pengukuranSkp']);
        $data['countPengukuranSkp_kegiatan_tugas_tambahan'] = count($data['pengukuranSkp_kegiatan_tugas_tambahan']);
        $data['countPengukuranSkp_kreativitas'] = count($data['pengukuranSkp_kreativitas']);
        $data['countPengukuranSkp_tugas_tambahan'] = count($data['pengukuranSkp_tugas_tambahan']);
        // $data['countPenilaianSkp'] = count($data['penilaianSkp']);
        // $data['countPerilakuKerjaSkp'] = count($data['perilakuKerjaSkp']);
        $data['totalKegiatan'] = 0;
        $data['totalAkTarget'] = 0;
        $data['totalKuantTarget1'] = 0;
        $data['totalKuantTarget2'] = 0;
        $data['totalKualTarget'] = 0;
        $data['totalBiayaTarget'] = 0;
        $data['totalAkRealisasi'] = 0;
        $data['totalKuantRealisasi'] = 0;
        $data['totalKuantRealisasi2'] = 0;
        $data['totalKualRealisasi'] = 0;
        $data['totalBiayaRealisasi'] = 0;
        $data['totalPenghitungan'] = 0;
        $data['totalNilaiCapaianSkp'] = 0;
        $data['totalNilaiCapaianSkp2'] = 0;
        $data['totalNilaiCapaianSkp3'] = 0;
        $data['totalWaktuTarget'] = 0;
        $data['totalWaktuRealisasi'] = 0;
        $data['nilaiCapaianSkp1'] = 0;
        $data['nilaiCapaianSkp2'] = 0;
        if ($data['countPengukuranSkp'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }

                $data['totalKegiatan'] += $value->kegiatan_tugas_tambahan;
                $data['totalAkTarget'] += $value->ak_target;
                $data['totalKuantTarget1'] += $value->target_kuant_output_1;
                $data['totalKuantTarget2'] += $value->target_kuant_output_2;
                $data['totalKualTarget'] += $value->target_kual_mutu;
                $data['totalWaktuTarget'] += $value->target_waktu;
                $data['totalBiayaTarget'] += $value->target_biaya;
                $data['totalAkRealisasi'] += $value->ak_realisasi;
                $data['totalKuantRealisasi'] += $value->realisasi_kuant_output_1;
                $data['totalKuantRealisasi2'] += $value->realisasi_kuant_output_2;
                $data['totalKualRealisasi'] += $value->realisasi_kual_mutu;
                $data['totalWaktuRealisasi'] += $value->realisasi_waktu;
                $data['totalBiayaRealisasi'] += $value->realisasi_biaya;
                $data['totalPenghitungan'] += $value['penghitungan'];
                $data['totalNilaiCapaianSkp'] += $value['nilai_capaian_skp'];

                // ($data['nilaiCapaianSkp1'] / $data['nilaiCapaianSkp2']) +  +  ;
            }
        }
        if ($data['countPengukuranSkp_kegiatan_tugas_tambahan'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp_kegiatan_tugas_tambahan'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }

                if ($value['nilai_capaian_skp'] === null || $value['nilai_capaian_skp'] === "" || $value['nilai_capaian_skp'] === 0) {
                    //do nothing karena 0
                } else {
                    $data['nilaiCapaianSkp1'] += $value['nilai_capaian_skp'];
                }
                if ($value->target_kuant_output_1 === null || $value->target_kuant_output_1 === "" || $value->target_kuant_output_1 === 0) {
                    //do nothing karena 0
                } else {
                    $data['nilaiCapaianSkp2'] += 1;
                }

                // ($data['nilaiCapaianSkp1'] / $data['nilaiCapaianSkp2']) +  +  ;
            }
        }
        if ($data['countPengukuranSkp_kreativitas'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp_kreativitas'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }
                $data['totalNilaiCapaianSkp2'] += $value['nilai_capaian_skp'];
            }
        }
        if ($data['countPengukuranSkp_tugas_tambahan'] === 0){
            //do nothing
        } else {
            foreach ($data['pengukuranSkp_tugas_tambahan'] as $key => $value) {
                //perhitungan
                $persen_waktu = 100 - ($value->realisasi_waktu / $value->target_waktu * 100);
                $kuantitas = $value->realisasi_kuant_output_1 / $value->target_kuant_output_1 * 100;
                $kualitas = $value->realisasi_kual_mutu / $value->target_kual_mutu * 100;
                if ($persen_waktu > 24) {
                    $waktu = 76 - ((((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100) - 100);
                } else {
                    $waktu = ((1.76 * $value->target_waktu - $value->realisasi_waktu) / $value->target_waktu) * 100;
                }
                if (!empty($value->realisasi_biaya)) {
                    $persen_biaya = 100 - ($value->realisasi_biaya / $value->target_biaya * 100);
                    if ( $persen_biaya > 24 ) {
                        $biaya = 76 - ((((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya) * 100) - 100);
                    } else {
                        $biaya = ((1.76 * $value->target_biaya - $value->realisasi_biaya) / $value->target_biaya)*100;
                    }
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu + $biaya;
                } else {
                    $value['penghitungan'] = $kuantitas + $kualitas + $waktu;
                }

                //capaian skp
                if (empty($value->realisasi_biaya)){
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 3;
                } else {
                    $value['nilai_capaian_skp'] = $value['penghitungan'] / 4;
                }
                $data['totalNilaiCapaianSkp3'] += $value['nilai_capaian_skp'];
            }
        }
        $data['nilaiCapaianSkpFinal1'] = ($data['nilaiCapaianSkp1'] / $data['nilaiCapaianSkp2']) + $data['totalNilaiCapaianSkp2'] + $data['totalNilaiCapaianSkp3'];
        if ($data['nilaiCapaianSkpFinal1'] <= 50) {
            $data['nilaiCapaianSkpFinal2'] = 'BURUK';
        } else {
            if ($data['nilaiCapaianSkpFinal1'] <= 75) {
                $data['nilaiCapaianSkpFinal2'] = 'CUKUP';
            } else {
                if ($data['nilaiCapaianSkpFinal1'] <= 90.99) {
                    $data['nilaiCapaianSkpFinal2'] = 'BAIK';
                } else {
                    $data['nilaiCapaianSkpFinal2'] = 'SANGAT BAIK';
                }
            }
        }
        if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 50) {
            $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 60) {
                $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 75) {
                    $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['orientasi_pelayanan'] <= 90.99) {
                        $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpOrientasiPelayanan'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['integritas'] <= 50) {
            $data['perilakuKerjaSkpIntegritas'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['integritas'] <= 60) {
                $data['perilakuKerjaSkpIntegritas'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['integritas'] <= 75) {
                    $data['perilakuKerjaSkpIntegritas'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['integritas'] <= 90.99) {
                        $data['perilakuKerjaSkpIntegritas'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpIntegritas'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['komitmen'] <= 50) {
            $data['perilakuKerjaSkpKomitmen'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['komitmen'] <= 60) {
                $data['perilakuKerjaSkpKomitmen'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['komitmen'] <= 75) {
                    $data['perilakuKerjaSkpKomitmen'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['komitmen'] <= 90.99) {
                        $data['perilakuKerjaSkpKomitmen'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpKomitmen'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['disiplin'] <= 50) {
            $data['perilakuKerjaSkpDisiplin'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['disiplin'] <= 60) {
                $data['perilakuKerjaSkpDisiplin'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['disiplin'] <= 75) {
                    $data['perilakuKerjaSkpDisiplin'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['disiplin'] <= 90.99) {
                        $data['perilakuKerjaSkpDisiplin'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpDisiplin'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['kerjasama'] <= 50) {
            $data['perilakuKerjaSkpKerjasama'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['kerjasama'] <= 60) {
                $data['perilakuKerjaSkpKerjasama'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['kerjasama'] <= 75) {
                    $data['perilakuKerjaSkpKerjasama'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['kerjasama'] <= 90.99) {
                        $data['perilakuKerjaSkpKerjasama'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpKerjasama'] = "(Sangat Baik)";
                    }
                }
            }
        }
        if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 50) {
            $data['perilakuKerjaSkpKepemimpinan'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 60) {
                $data['perilakuKerjaSkpKepemimpinan'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 75) {
                    $data['perilakuKerjaSkpKepemimpinan'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkp']['kepemimpinan'] <= 90.99) {
                        $data['perilakuKerjaSkpKepemimpinan'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpKepemimpinan'] = "(Sangat Baik)";
                    }
                }
            }
        }
        $data['perilakuKerjaSkpJumlah'] = $data['perilakuKerjaSkp']['kepemimpinan']
            + $data['perilakuKerjaSkp']['kerjasama']
            + $data['perilakuKerjaSkp']['disiplin']
            + $data['perilakuKerjaSkp']['komitmen']
            + $data['perilakuKerjaSkp']['integritas']
            + $data['perilakuKerjaSkp']['orientasi_pelayanan'];
        if ($data['perilakuKerjaSkp']['kepemimpinan'] === null
            || $data['perilakuKerjaSkp']['kepemimpinan'] === 0
            || $data['perilakuKerjaSkp']['kepemimpinan'] === "") {
                $data['perilakuKerjaSkpRata'] = $data['perilakuKerjaSkpJumlah'] / 5;
        } else {
            $data['perilakuKerjaSkpRata'] = $data['perilakuKerjaSkpJumlah'] / 6;
        }
        if ($data['perilakuKerjaSkpRata'] <= 50) {
            $data['perilakuKerjaSkpRatarata'] = "(Buruk)";
        } else {
            if ($data['perilakuKerjaSkpRata'] <= 60) {
                $data['perilakuKerjaSkpRatarata'] = "(Kurang)";
            } else {
                if ($data['perilakuKerjaSkpRata'] <= 75) {
                    $data['perilakuKerjaSkpRatarata'] = "(Cukup)";
                } else {
                    if ($data['perilakuKerjaSkpRata'] <= 90.99) {
                        $data['perilakuKerjaSkpRatarata'] = "(Baik)";
                    } else {
                        $data['perilakuKerjaSkpRatarata'] = "(Sangat Baik)";
                    }
                }
            }
        }
        $data['penilaianSasaranKerjaPegawai'] = $data['nilaiCapaianSkpFinal1'] * 60 / 100;
        $data['penilaianNilaiPerilakuKerja'] = $data['perilakuKerjaSkpRata'] * 40 / 100;
        $data['penilaianNilaiPrestasiKerja'] =  $data['penilaianSasaranKerjaPegawai'] + $data['penilaianNilaiPerilakuKerja'];
        if ($data['penilaianNilaiPrestasiKerja'] <= 50) {
            $data['penilaianNilaiPrestasiKerja2'] = "(Buruk)";
        } else {
            if ($data['penilaianNilaiPrestasiKerja'] <= 60) {
                $data['penilaianNilaiPrestasiKerja2'] = "(Kurang)";
            } else {
                if ($data['penilaianNilaiPrestasiKerja'] <= 75) {
                    $data['penilaianNilaiPrestasiKerja2'] = "(Cukup)";
                } else {
                    if ($data['penilaianNilaiPrestasiKerja'] <= 90.99) {
                        $data['penilaianNilaiPrestasiKerja2'] = "(Baik)";
                    } else {
                        $data['penilaianNilaiPrestasiKerja2'] = "(Sangat Baik)";
                    }
                }
            }
        }
        $convertTanggal = New Carbon($data['penilaianSkp']['tanggal_keberatan_pegawai']);
        $data['penilaianSkp']['tanggal_keberatan_pegawai'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['tanggal_tanggapan_pejabat']);
        $data['penilaianSkp']['tanggal_tanggapan_pejabat'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['tanggal_keputusan_atasan_pejabat']);
        $data['penilaianSkp']['tanggal_keputusan_atasan_pejabat'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['dibuat_tanggal_pejabat_penilai']);
        $data['penilaianSkp']['dibuat_tanggal_pejabat_penilai'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['diterima_tanggal_pegawai']);
        $data['penilaianSkp']['diterima_tanggal_pegawai'] = $convertTanggal->translatedFormat('d F Y');
        $convertTanggal = New Carbon($data['penilaianSkp']['diterima_tanggal_atasan_pejabat_penilai']);
        $data['penilaianSkp']['diterima_tanggal_atasan_pejabat_penilai'] = $convertTanggal->translatedFormat('d F Y');


        // dd($data['perilakuKerjaSkp']['orientasi_pelayanan']);
        return view('admin/pegawai/skp',$data);
    }
}
