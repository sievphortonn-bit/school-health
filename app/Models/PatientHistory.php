<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;
    protected $table = 'patients_histories';
    protected $fillable = [
        'patient_id',
        'complaint',
        'intervention',
        'treatment',
        'administered_by',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
