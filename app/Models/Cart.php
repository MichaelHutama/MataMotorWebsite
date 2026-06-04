<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'CartID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['CartID', 'CustomerID', 'SparePartID', 'Quantity', 'IsChecked'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->CartID)) {
                $model->CartID = IdGenerator::cart($model->CustomerID);
            }
        });
    }

    public function customer()  { return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID'); }
    public function sparePart() { return $this->belongsTo(SparePart::class, 'SparePartID', 'SparePartID'); }
}