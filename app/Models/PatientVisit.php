<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVisit extends Model
{
    protected $fillable = [
        'patient_type',
        'patient_id',
        'complaint',
        'intervention',
        'treatment',
        'administered_by',
        'remark'
    ];
    public function histories()
    {
        return $this->hasMany(patients_histories::class);
    }
}

