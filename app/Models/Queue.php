<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class Queue extends Model
{
    protected $table = 'queues';
    protected $primaryKey = 'QueueID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['QueueID', 'CustomerID', 'VehicleID', 'BookingTime', 'ServiceCategoryID', 'Description', 'QueueStatus'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->QueueID)) {
                // Gunakan BookingTime yang sudah diset
                $model->QueueID = IdGenerator::queue($model->BookingTime);
            }
        });
    }

    public function customer()         { return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID'); }
    public function vehicle()          { return $this->belongsTo(Vehicle::class, 'VehicleID', 'VehicleID'); }
    public function serviceCategory()  { return $this->belongsTo(ServiceCategory::class, 'ServiceCategoryID', 'ServiceCategoryID'); }
    public function servicePerformed() { return $this->hasOne(ServicePerformed::class, 'QueueID', 'QueueID'); }
}