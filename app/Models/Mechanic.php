<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mechanic extends Authenticatable
{
    protected $table = 'Mechanic';
    protected $primaryKey = 'MechanicID';
    public $incrementing = false;
    protected $keyType = 'string';

    // TAMBAHKAN BARIS INI:
    public $timestamps = false; 

    protected $guarded = [];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->MechanicID) {
                $latest = self::where('MechanicID', '!=', 'MEC-0')
                    ->orderByRaw('CAST(SUBSTRING(MechanicID, 5) AS UNSIGNED) DESC')
                    ->first();
                $num = $latest ? ((int) substr($latest->MechanicID, 4)) + 1 : 1;
                $model->MechanicID = 'MEC-' . $num;
            }
        });
    }
}