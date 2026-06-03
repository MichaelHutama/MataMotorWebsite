<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'Cart';
    protected $primaryKey = 'CartID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::where('CustomerID', $model->CustomerID)
                ->orderByRaw('CAST(SUBSTRING_INDEX(CartID, "-CART-", -1) AS UNSIGNED) DESC')
                ->first();
            $num = $latest ? ((int) substr(strrchr($latest->CartID, "-"), 1)) + 1 : 1;
            $model->CartID = strtoupper($model->CustomerID . '-CART-' . $num);
        });
    }
}