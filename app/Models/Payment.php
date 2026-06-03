<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Payment';
    protected $primaryKey = 'PaymentID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::where('TransactionID', $model->TransactionID)
                ->orderByRaw('CAST(SUBSTRING_INDEX(PaymentID, "-PAY-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->PaymentID, "-"), 1)) + 1 : 1;
            $model->PaymentID = strtoupper($model->TransactionID . '-PAY-' . $num);
        });
    }
}