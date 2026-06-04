<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class SparePartSales extends Model
{
    protected $table = 'spare_part_sales';
    protected $primaryKey = 'SparePartSalesID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'SparePartSalesID', 'TransactionID', 'Type', 'Status',
        'PriceAtPurchase', 'DeliveryMethod', 'ReceiverName',
        'ReceiverPhone', 'ReceiverAddress', 'Notes',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->SparePartSalesID)) {
                $model->SparePartSalesID = IdGenerator::sparePartSales($model->TransactionID);
            }
        });
    }

    public function transaction() { return $this->belongsTo(Transaction::class, 'TransactionID', 'TransactionID'); }
    public function items()       { return $this->hasMany(SparePartSalesItem::class, 'SparePartSalesID', 'SparePartSalesID'); }
}