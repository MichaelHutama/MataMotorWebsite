<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class SparePartCategory extends Model
{
    protected $table = 'spare_part_categories';
    protected $primaryKey = 'SparePartCategoryID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['SparePartCategoryID', 'SparePartCategoryName'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->SparePartCategoryID)) {
                $model->SparePartCategoryID = IdGenerator::sparePartCategory();
            }
        });
    }

    public function spareParts() {
        return $this->hasMany(SparePart::class, 'SparePartCategoryID', 'SparePartCategoryID');
    }
}