<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'Vehicle';
    protected $primaryKey = 'VehicleID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::where('CustomerID', $model->CustomerID)
                ->orderByRaw('CAST(SUBSTRING_INDEX(VehicleID, "-VEC-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->VehicleID, "-"), 1)) + 1 : 1;
            $model->VehicleID = strtoupper($model->CustomerID . '-VEC-' . $num);
        });
    }
}