<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'age',
        'sex',
        'role',
    ];

    // Khmer accessor
    public function getSexKhAttribute()
    {
        return match ($this->sex) {
            'Male' => 'ប្រុស',
            'Female' => 'ស្រី',
            default => '-',
        };
    }
}
