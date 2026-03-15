<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('students')
            ->orderBy('course_code')
            ->get();

        return CourseResource::collection($courses);
    }
}