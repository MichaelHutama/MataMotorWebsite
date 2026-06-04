<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\IdGenerator;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $primaryKey = 'CustomerID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CustomerID', 'CustomerName', 'ProfilePicture',
        'Email', 'Password', 'Number', 'Address',
    ];
    protected $hidden = ['Password'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->CustomerID)) {
                $model->CustomerID = IdGenerator::customer();
            }
        });
    }

    public function getAuthPassword() { return $this->Password; }

    public function vehicles()     { return $this->hasMany(Vehicle::class, 'CustomerID', 'CustomerID'); }
    public function queues()       { return $this->hasMany(Queue::class, 'CustomerID', 'CustomerID'); }
    public function carts()        { return $this->hasMany(Cart::class, 'CustomerID', 'CustomerID'); }
    public function transactions() { return $this->hasMany(Transaction::class, 'CustomerID', 'CustomerID'); }
}