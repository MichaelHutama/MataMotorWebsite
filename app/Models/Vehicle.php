<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'VehicleID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['VehicleID', 'CustomerID', 'VehicleCategory', 'Brand', 'ProductionYear', 'PlateNumber'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->VehicleID)) {
                // Butuh CustomerID untuk generate ID
                $model->VehicleID = IdGenerator::vehicle($model->CustomerID);
            }
        });
    }

    public function customer()  { return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID'); }
    public function queues()    { return $this->hasMany(Queue::class, 'VehicleID', 'VehicleID'); }
    public function services()  { return $this->hasMany(ServicePerformed::class, 'VehicleID', 'VehicleID'); }
}
