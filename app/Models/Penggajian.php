<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penggajian extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_komponen_gaji",
        "id_anggota",
    ];
    protected $table = 'penggajian';
    protected $primaryKey = 'id_komponen_gaji, id_anggota';
    public function komponen_gaji()
    {
        return $this->belongsTo(KomponenGaji::class, 'id_komponen_gaji', 'id_komponen_gaji');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }
    
    public $timestamps = false;
}
