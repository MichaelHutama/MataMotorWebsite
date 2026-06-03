<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SparePart  extends Authenticatable
{
    protected $table = 'SparePart';
    protected $primaryKey = 'SparePartID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Otomatisasi ID Sequence SP-xxx
    protected static function booted()
    {
        static::creating(function ($model) {
            // Jika Anda sengaja menginput manual 'SP-0' lewat Seeder/Form untuk Owner, logika ini dilewati
            if (!$model->SparePartID) {
                $latest = self::where('SparePartID', '!=', 'SP-0')
                    ->orderByRaw('CAST(SUBSTRING(SparePartID, 4) AS UNSIGNED) DESC')
                    ->first();
                $num = $latest ? ((int) substr($latest->SparePartID, 3)) + 1 : 1;
                $model->SparePartID = 'SP-' . $num;
            }
        });
    }
}
