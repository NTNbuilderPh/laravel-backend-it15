<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'day_type',
        'attendance_count',
        'remarks',
        'school_year',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
