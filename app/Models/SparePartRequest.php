<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartRequest extends Model
{
    protected $table = 'SparePartRequest';
    protected $primaryKey = 'SparePartRequestID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::where('ServiceID', $model->ServiceID)
                ->orderByRaw('CAST(SUBSTRING_INDEX(SparePartRequestID, "-SPR-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->SparePartRequestID, "-"), 1)) + 1 : 1;
            $model->SparePartRequestID = strtoupper("SPR-" . $model->ServiceID . "-" . $num);
        });
    }
}