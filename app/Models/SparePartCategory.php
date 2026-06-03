<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SparePartCategory extends Authenticatable
{
    protected $table = 'SparePartCategory';
    protected $primaryKey = 'SparePartCategoryID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Otomatisasi ID Sequence SPC-xxx
    protected static function booted()
    {
        static::creating(function ($model) {
            // Jika Anda sengaja menginput manual 'SPC-0' lewat Seeder/Form untuk Owner, logika ini dilewati
            if (!$model->SparePartCategoryID) {
                $latest = self::where('SparePartCategoryID', '!=', 'SPC-0')
                    ->orderByRaw('CAST(SUBSTRING(SparePartCategoryID, 5) AS UNSIGNED) DESC')
                    ->first();
                $num = $latest ? ((int) substr($latest->SparePartCategoryID, 4)) + 1 : 1;
                $model->SparePartCategoryID = 'SPC-' . $num;
            }
        });
    }
}
