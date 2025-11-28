<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

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

    protected $casts = [
        'tanggal_masuk' => 'datetime',
    ];

    protected function fotoKondisi(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (!$value) return null;
                
                // If it's already a full URL, return as-is
                if (str_starts_with($value, 'http')) {
                    return $value;
                }
                
                // If it's a relative path, convert to full URL
                return Storage::url($value);
            },
        );
    }

    protected static function boot()
    {
        parent::boot();

        // Delete old image when updating
        static::updating(function ($tank) {
            if ($tank->isDirty('foto_kondisi') && $tank->getOriginal('foto_kondisi')) {
                Storage::disk('public')->delete($tank->getOriginal('foto_kondisi'));
            }
        });

        // Delete image when deleting
        static::deleting(function ($tank) {
            if ($tank->foto_kondisi) {
                Storage::disk('public')->delete($tank->foto_kondisi);
            }
        });
    }
}
