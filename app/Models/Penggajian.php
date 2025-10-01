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
    public function kompenen()
    {
        return $this->belongsTo(KomponenGaji::class);
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    
    public $timestamps = false;
}
