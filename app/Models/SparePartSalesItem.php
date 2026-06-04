<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartSalesItem extends Model
{
    protected $table = 'spare_part_sales_items';
    // Composite PK — Eloquent tidak support native, gunakan ini:
    public $incrementing = false;
    protected $fillable = ['SparePartSalesID', 'SparePartID', 'Amount'];

    public function sparePart()      { return $this->belongsTo(SparePart::class, 'SparePartID', 'SparePartID'); }
    public function sparePartSales() { return $this->belongsTo(SparePartSales::class, 'SparePartSalesID', 'SparePartSalesID'); }
}
