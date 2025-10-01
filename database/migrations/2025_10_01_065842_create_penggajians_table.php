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
        if (!Schema::hasTable('penggajian')) {
            Schema::create('penggajian', function (Blueprint $table) {
                $table->unsignedBigInteger('id_komponen_gaji');
                $table->unsignedBigInteger('id_anggota');

                $table->foreign('id_komponen_gaji')->references('id')->on('komponen_gaji')->onDelete('cascade');
                $table->foreign('id_komponen_gaji')->references('id')->on('anggota')->onDelete('cascade');
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
        Schema::dropIfExists('penggajian');
    }
};
