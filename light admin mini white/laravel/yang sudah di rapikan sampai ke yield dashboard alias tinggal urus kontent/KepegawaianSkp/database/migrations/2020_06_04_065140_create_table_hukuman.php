<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHukuman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hukuman', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->foreignID('pegawai_id')->constrained('pegawai');
            $table->integer('kode_hukuman')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->datetime('tanggal_sk')->nullable();
            $table->datetime('tmt_berlaku')->nullable();
            $table->string('pejabat_pembuat_sk')->nullable();
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
        Schema::dropIfExists('hukuman');
    }
}
