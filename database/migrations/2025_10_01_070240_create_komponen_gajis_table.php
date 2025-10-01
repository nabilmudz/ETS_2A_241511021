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
        if (!Schema::hasTable('komponen_gaji')) {
            Schema::create('komponen_gaji', function (Blueprint $table) {
                $table->id('id_komponen_gaji');
                $table->string('nama_depan')->nullable(false);
                $table->enum('kategori', ['Gaji Pokok', 'Tunjangan Melekat', 'Tunjangan Lain']);
                $table->enum('jabatan', ['Ketua', 'Wakil Ketua', 'Anggota', 'Semua']);
                $table->decimal('nominal', 17,2)->nullable(false);
                $table->enum('satuan', ['Bulan', 'Hari', 'Periode']);
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
        Schema::dropIfExists('komponen_gaji');
    }
};
