<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Helpers\IdGenerator;

class Mechanic extends Authenticatable
{
    protected $table = 'mechanics';
    protected $primaryKey = 'MechanicID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'MechanicID', 'MechanicName', 'Number', 'IsActive', 'Password',
    ];
    protected $hidden = ['Password'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // MEC-0 di-seed manual — auto-generate hanya jika belum diset
            if (empty($model->MechanicID)) {
                $model->MechanicID = IdGenerator::mechanic();
            }
        });
    }

    public function isOwner(): bool { return $this->MechanicID === 'MEC-0'; }
    public function getAuthPassword() { return $this->Password; }

    public function specializations() {
        return $this->belongsToMany(
            ServiceCategory::class,
            'mechanic_specializations',
            'MechanicID', 'ServiceCategoryID'
        );
    }
    public function assignments() {
        return $this->hasMany(MechanicAssignment::class, 'MechanicID', 'MechanicID');
    }
    public function sparePartRequests() {
        return $this->hasMany(SparePartRequest::class, 'MechanicID', 'MechanicID');
    }
}