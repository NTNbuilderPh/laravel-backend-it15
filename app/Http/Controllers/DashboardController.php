<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SchoolDay;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        $schoolYear = '2025-2026';

        $totalStudents = Student::where('school_year', $schoolYear)->count();
        $totalCourses = Course::count();
        $schoolDays = SchoolDay::where('school_year', $schoolYear)
            ->where('day_type', 'regular')
            ->count();

        $averageAttendance = round(
            SchoolDay::where('school_year', $schoolYear)
                ->whereIn('day_type', ['regular', 'event'])
                ->avg('attendance_count') ?? 0
        );

        return response()->json([
            'school_year' => $schoolYear,
            'total_students' => $totalStudents,
            'total_courses' => $totalCourses,
            'school_days' => $schoolDays,
            'average_attendance' => $averageAttendance,
        ]);
    }

    public function enrollmentTrends(): JsonResponse
    {
        $schoolYear = '2025-2026';

        $rawData = Student::selectRaw('MONTH(enrollment_date) as month_number, COUNT(*) as total')
            ->where('school_year', $schoolYear)
            ->groupBy('month_number')
            ->orderBy('month_number')
            ->get();

        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        $data = $rawData->map(function ($item) use ($monthNames) {
            return [
                'month' => $monthNames[$item->month_number] ?? 'Unknown',
                'total' => (int) $item->total,
            ];
        });

        return response()->json($data);
    }

    public function courseDistribution(): JsonResponse
    {
        $schoolYear = '2025-2026';

        $distribution = Course::leftJoin('students', function ($join) use ($schoolYear) {
            $join->on('courses.id', '=', 'students.course_id')
                ->where('students.school_year', '=', $schoolYear);
        })
            ->select(
                'courses.id',
                'courses.course_code',
                'courses.course_name',
                DB::raw('COUNT(students.id) as students_count')
            )
            ->groupBy('courses.id', 'courses.course_code', 'courses.course_name')
            ->orderByDesc('students_count')
            ->get();

        return response()->json($distribution);
    }

    public function attendancePatterns(): JsonResponse
    {
        $schoolYear = '2025-2026';

        $attendance = SchoolDay::where('school_year', $schoolYear)
            ->whereIn('day_type', ['regular', 'event'])
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date->format('Y-m-d'),
                    'attendance_count' => $item->attendance_count,
                    'day_type' => $item->day_type,
                    'remarks' => $item->remarks,
                ];
            });

        return response()->json($attendance);
    }

    public function demographics(): JsonResponse
    {
        $schoolYear = '2025-2026';

        $genderDistribution = Student::select('gender', DB::raw('COUNT(*) as total'))
            ->where('school_year', $schoolYear)
            ->groupBy('gender')
            ->get();

        $yearLevelDistribution = Student::select('year_level', DB::raw('COUNT(*) as total'))
            ->where('school_year', $schoolYear)
            ->groupBy('year_level')
            ->get();

        $cityDistribution = Student::select('city', DB::raw('COUNT(*) as total'))
            ->where('school_year', $schoolYear)
            ->groupBy('city')
            ->orderByDesc('total')
            ->get();

        return response()->json([
            'gender_distribution' => $genderDistribution,
            'year_level_distribution' => $yearLevelDistribution,
            'city_distribution' => $cityDistribution,
        ]);
    }
}
