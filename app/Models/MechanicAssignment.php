<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MechanicAssignment extends Model
{
    protected $table = 'mechanic_assignments';
    public $incrementing = false;
    protected $fillable = ['MechanicID', 'ServiceID'];

    public function mechanic()          { return $this->belongsTo(Mechanic::class, 'MechanicID', 'MechanicID'); }
    public function servicePerformed()  { return $this->belongsTo(ServicePerformed::class, 'ServiceID', 'ServiceID'); }
}