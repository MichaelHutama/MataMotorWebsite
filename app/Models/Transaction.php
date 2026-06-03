<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'Transaction';
    protected $primaryKey = 'TransactionID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $date = now()->format('Ymd');
            $latest = self::where('TransactionID', 'like', "T-$date-%")
                ->orderByRaw('CAST(SUBSTRING_INDEX(TransactionID, "-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->TransactionID, "-"), 1)) + 1 : 1;
            $model->TransactionID = "T-{$date}-{$num}";
        });
    }
}