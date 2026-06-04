<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class SparePart extends Model
{
    protected $table = 'spare_parts';
    protected $primaryKey = 'SparePartID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['SparePartID', 'SparePartCategoryID', 'Name', 'Description', 'Stock', 'Price', 'Image'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->SparePartID)) {
                $model->SparePartID = IdGenerator::sparePart();
            }
        });
    }

    public function category()  { return $this->belongsTo(SparePartCategory::class, 'SparePartCategoryID', 'SparePartCategoryID'); }
    public function cartItems() { return $this->hasMany(Cart::class, 'SparePartID', 'SparePartID'); }
}