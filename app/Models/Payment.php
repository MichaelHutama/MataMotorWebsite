<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\IdGenerator;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'PaymentID';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['PaymentID', 'TransactionID', 'PaymentDocument', 'PaymentTime', 'PaymentStatus', 'PaymentAmount', 'PaymentMethod'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->PaymentID)) {
                $model->PaymentID = IdGenerator::payment($model->TransactionID);
            }
        });
    }

    public function transaction() { return $this->belongsTo(Transaction::class, 'TransactionID', 'TransactionID'); }
}