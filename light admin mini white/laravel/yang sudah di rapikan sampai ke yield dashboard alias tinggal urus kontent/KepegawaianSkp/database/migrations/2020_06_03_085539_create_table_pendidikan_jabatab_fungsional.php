<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePendidikanJabatabFungsional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatan_fungsional', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->foreignID('pegawai_id')->constrained('pegawai');
            $table->string('eselon')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->datetime('tmt_jabatan')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->datetime('tanggal_sk')->nullable();
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
        Schema::dropIfExists('jabatan_fungsional');
    }
}
