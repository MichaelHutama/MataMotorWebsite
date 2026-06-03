<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartSales extends Model
{
    protected $table = 'SparePartSales';
    protected $primaryKey = 'SparePartSalesID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::where('TransactionID', $model->TransactionID)
                ->orderByRaw('CAST(SUBSTRING_INDEX(SparePartSalesID, "-SPS-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->SparePartSalesID, "-"), 1)) + 1 : 1;
            $model->SparePartSalesID = strtoupper("SPS-" . $model->TransactionID . "-" . $num);
        });
    }
}