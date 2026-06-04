<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class ServicePerformed extends Model
{
    protected $table = 'service_performed';
    protected $primaryKey = 'ServiceID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ServiceID', 'TransactionID', 'QueueID', 'VehicleID',
        'ServiceCategoryID', 'PriceAtService', 'Status', 'Rating', 'ReviewDesc',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->ServiceID)) {
                $model->ServiceID = IdGenerator::servicePerformed($model->TransactionID);
            }
        });
    }

    public function transaction()      { return $this->belongsTo(Transaction::class, 'TransactionID', 'TransactionID'); }
    public function queue()            { return $this->belongsTo(Queue::class, 'QueueID', 'QueueID'); }
    public function vehicle()          { return $this->belongsTo(Vehicle::class, 'VehicleID', 'VehicleID'); }
    public function serviceCategory()  { return $this->belongsTo(ServiceCategory::class, 'ServiceCategoryID', 'ServiceCategoryID'); }
    public function assignments()      { return $this->hasMany(MechanicAssignment::class, 'ServiceID', 'ServiceID'); }
    public function sparePartRequests(){ return $this->hasMany(SparePartRequest::class, 'ServiceID', 'ServiceID'); }
}