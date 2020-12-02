<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('eselon_1')->nullable();
            $table->string('eselon_2')->nullable();
            $table->string('eselon_3')->nullable();
            $table->string('eselon_4')->nullable();
            $table->string('nip_baru')->nullable();
            $table->string('nip_lama')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->datetime('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin',['P','W'])->nullable();
            $table->enum('status_keluarga',['K','B','D','J'])->nullable();
            $table->integer('agama')->nullable();
            $table->string('pendidikan_akhir')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('jurusan_prodi')->nullable();
            $table->integer('status_kepegawaian')->nullable();
            $table->string('instansi_asal')->nullable();
            $table->datetime('tmt_cpns')->nullable();
            $table->string('golongan')->nullable();
            $table->datetime('tmt_golongan')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->string('nomor_karpeg')->nullable();
            $table->integer('taspen')->nullable();
            $table->string('nomor_npwp')->nullable();
            $table->text('alamat_rumah')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('str')->nullable();
            $table->datetime('masa_str')->nullable();
            $table->string('sikp')->nullable();
            $table->datetime('masa_sikp')->nullable();
            $table->string('spk')->nullable();
            $table->datetime('masa_spk')->nullable();
            $table->string('rkk')->nullable();
            $table->datetime('masa_rkk')->nullable();
            $table->foreignID('ruangan_id')->constrained('ruangan')->nullable();
            $table->enum('active',['1','0']);
            $table->foreignID('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
