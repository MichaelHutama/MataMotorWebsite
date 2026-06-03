<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ServiceCategory extends Authenticatable
{
    protected $table = 'ServiceCategory';
    protected $primaryKey = 'ServiceCategoryID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Otomatisasi ID Sequence SVC-xxx
    protected static function booted()
    {
        static::creating(function ($model) {
            // Jika Anda sengaja menginput manual 'SVC-0' lewat Seeder/Form untuk Owner, logika ini dilewati
            if (!$model->ServiceCategoryID) {
                $latest = self::where('ServiceCategoryID', '!=', 'SVC-0')
                    ->orderByRaw('CAST(SUBSTRING(ServiceCategoryID, 5) AS UNSIGNED) DESC')
                    ->first();
                $num = $latest ? ((int) substr($latest->ServiceCategoryID, 4)) + 1 : 1;
                $model->ServiceCategoryID = 'SVC-' . $num;
            }
        });
    }
}
