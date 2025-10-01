<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('anggota')) {

            Schema::create('anggota', function (Blueprint $table) {
                $table->id('id_anggota');
                $table->string('nama_depan')->nullable(false);
                $table->string('nama_belakang')->nullable(false);
                $table->string('gelar_depan')->nullable();
                $table->string('gelar_belakang')->nullable();
                $table->enum('jabatan', ['Ketua', 'Wakil Ketua', 'Anggota'])->nullable();
                $table->enum('status_pernikahan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati'], )->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
};
