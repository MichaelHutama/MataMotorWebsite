<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MechanicSpecialization extends Model
{
    protected $table = 'mechanic_specializations';
    public $incrementing = false;
    protected $fillable = ['MechanicID', 'ServiceCategoryID'];

    public function mechanic()         { return $this->belongsTo(Mechanic::class, 'MechanicID', 'MechanicID'); }
    public function serviceCategory()  { return $this->belongsTo(ServiceCategory::class, 'ServiceCategoryID', 'ServiceCategoryID'); }
}