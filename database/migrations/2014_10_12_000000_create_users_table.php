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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna')->nullable(false);
            $table->string('username')->unique()->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('nama_depan')->nullable()->nullable(false);
            $table->string('nama_belakang')->nullable()->nullable(false);
            $table->enum('role',['Admin', 'Public'])->nullable()->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};
