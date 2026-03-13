<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patirn_history extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'complaint',
        'intervention',
        'treatment',
        'administered_by',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientVisit::class);
    }
}
