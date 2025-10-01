<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_komponen",
        "kategori",
        "jabatan",
        "nominal",
        "satuan",
    ];
    
}
