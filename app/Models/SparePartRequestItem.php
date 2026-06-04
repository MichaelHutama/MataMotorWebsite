<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePartRequestItem extends Model
{
    protected $table = 'spare_part_request_items';
    public $incrementing = false;
    protected $fillable = ['SparePartRequestID', 'SparePartID', 'Amount'];

    public function sparePart()         { return $this->belongsTo(SparePart::class, 'SparePartID', 'SparePartID'); }
    public function sparePartRequest()  { return $this->belongsTo(SparePartRequest::class, 'SparePartRequestID', 'SparePartRequestID'); }
}
