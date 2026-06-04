<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'TransactionID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['TransactionID', 'CustomerID', 'TransactionTime'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->TransactionID)) {
                $model->TransactionID = IdGenerator::transaction();
            }
        });
    }

    public function customer()          { return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID'); }
    public function sparepartSales()    { return $this->hasMany(SparePartSales::class, 'TransactionID', 'TransactionID'); }
    public function servicesPerformed() { return $this->hasMany(ServicePerformed::class, 'TransactionID', 'TransactionID'); }
    public function payment()           { return $this->hasOne(Payment::class, 'TransactionID', 'TransactionID'); }
}
