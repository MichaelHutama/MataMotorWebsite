<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'Customer';
    protected $primaryKey = 'CustomerID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];

    // Mengarahkan kolom password kustom ke sistem Auth Laravel
    public function getAuthPassword()
    {
        return $this->Password;
    }

    // Otomatisasi ID Sequence CUS-xxx
    protected static function booted()
    {
        static::creating(function ($model) {
            $latest = self::orderByRaw('CAST(SUBSTRING(CustomerID, 5) AS UNSIGNED) DESC')->first();
            $num = $latest ? ((int) substr($latest->CustomerID, 4)) + 1 : 1;
            $model->CustomerID = 'CUS-' . $num;
        });
    }
}