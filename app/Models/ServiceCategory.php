<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';
    protected $primaryKey = 'ServiceCategoryID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['ServiceCategoryID', 'ServiceCategoryName', 'ServiceIcon', 'ServicePrice'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->ServiceCategoryID)) {
                $model->ServiceCategoryID = IdGenerator::serviceCategory();
            }
        });
    }

    public function mechanics() {
        return $this->belongsToMany(Mechanic::class, 'mechanic_specializations', 'ServiceCategoryID', 'MechanicID');
    }
    public function queues() {
        return $this->hasMany(Queue::class, 'ServiceCategoryID', 'ServiceCategoryID');
    }
}