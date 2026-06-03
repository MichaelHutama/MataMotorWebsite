<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'Queue';
    protected $primaryKey = 'QueueID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $date = now()->format('Ymd');
            $latest = self::where('QueueID', 'like', "Q-$date-%")
                ->orderByRaw('CAST(SUBSTRING_INDEX(QueueID, "-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->QueueID, "-"), 1)) + 1 : 1;
            $model->QueueID = "Q-{$date}-{$num}";
        });
    }
}
