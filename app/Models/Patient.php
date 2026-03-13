<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_type',     // student | teacher
        'ref_id',           // student_id or teacher_id
        'name',
        'age',
        'sex',
        'grade_or_level',
    ];

    // One patient → many histories (visits)
    public function histories()
    {
        return $this->hasMany(PatientHistory::class);
    }
}
