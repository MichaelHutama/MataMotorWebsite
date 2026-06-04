<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class SparePartRequest extends Model
{
    protected $table = 'spare_part_requests';
    protected $primaryKey = 'SparePartRequestID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['SparePartRequestID', 'ServiceID', 'MechanicID', 'Notes', 'Status'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->SparePartRequestID)) {
                $model->SparePartRequestID = IdGenerator::sparePartRequest($model->ServiceID);
            }
        });
    }

    public function servicePerformed() { return $this->belongsTo(ServicePerformed::class, 'ServiceID', 'ServiceID'); }
    public function mechanic()         { return $this->belongsTo(Mechanic::class, 'MechanicID', 'MechanicID'); }
    public function items()            { return $this->hasMany(SparePartRequestItem::class, 'SparePartRequestID', 'SparePartRequestID'); }
}