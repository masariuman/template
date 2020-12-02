<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableJabatanTeknis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerjaan_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->foreignID('pegawai_id')->constrained('pegawai');
            $table->string('nama_jabatan')->nullable();
            $table->datetime('tmt_jabatan')->nullable();
            $table->string('tahun_mulai')->nullable();
            $table->string('tahun_selesai')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->datetime('tanggal_sk')->nullable();
            $table->string('nip_pejabat_penandatangan_sk')->nullable();
            $table->string('nip_lama_pejabat_penandatangan_sk')->nullable();
            $table->string('pejabat_penandatangan_sk')->nullable();
            $table->enum('active',['1','0']);
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
        Schema::dropIfExists('pekerjaan_jabatan');
    }
}
