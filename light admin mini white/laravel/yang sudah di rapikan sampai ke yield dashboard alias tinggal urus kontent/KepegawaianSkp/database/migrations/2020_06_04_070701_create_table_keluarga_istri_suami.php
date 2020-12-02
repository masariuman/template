<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKeluargaIstriSuami extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga_istri_suami', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->foreignID('pegawai_id')->constrained('pegawai');
            $table->string('nama')->nullable();
            $table->integer('hubungan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->datetime('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin',['L','P'])->nullable();
            $table->enum('kondisi',['1','0'])->nullable();
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
        Schema::dropIfExists('keluarga_istri_suami');
    }
}
