<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePerformed extends Model
{
    protected $table = 'ServicePerformed';
    protected $primaryKey = 'ServicePerformedID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::where('TransactionID', $model->TransactionID)
                ->orderByRaw('CAST(SUBSTRING_INDEX(ServicePerformedID, "-SVP-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->ServicePerformedID, "-"), 1)) + 1 : 1;
            $model->ServicePerformedID = strtoupper("SVP-" . $model->TransactionID . "-" . $num);
        });
    }
}