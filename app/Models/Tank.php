<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    protected $fillable = [
        'tanggal_masuk',
        'nama_konsumen',
        'foto_kondisi',
        'plat_no',
        'no_mesin',
        'no_rangka',
        'kesimpulan',
    ];
}
