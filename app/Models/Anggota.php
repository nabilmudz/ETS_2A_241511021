<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_depan",
        "nama_belakang",
        "gelar_depan",
        "gelar_belakang",
        "jabatan",
        "status_pernikahan",
    ];
    public function penggajian()
    {
        return $this->hasMany(Penggajian::class);
    }
}
