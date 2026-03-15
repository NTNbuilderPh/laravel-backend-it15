<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'birthdate',
        'address',
        'province',
        'city',
        'year_level',
        'course_id',
        'enrollment_date',
        'status',
        'school_year',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'enrollment_date' => 'date',
    ];

    protected $appends = [
        'full_name',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . ($this->middle_name ? $this->middle_name . ' ' : '') . $this->last_name);
    }
}