<?php

namespace Database\Seeders;

use App\Models\SchoolDay;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SchoolDaySeeder extends Seeder
{
    public function run(): void
    {
        $startDate = Carbon::create(2025, 8, 1);
        $endDate = Carbon::create(2026, 5, 31);

        $holidays = [
            '2025-08-21' => 'Ninoy Aquino Day',
            '2025-11-01' => 'All Saints’ Day',
            '2025-11-30' => 'Bonifacio Day',
            '2025-12-25' => 'Christmas Day',
            '2025-12-30' => 'Rizal Day',
            '2026-01-01' => 'New Year’s Day',
            '2026-02-25' => 'EDSA People Power Anniversary',
            '2026-04-09' => 'Araw ng Kagitingan',
            '2026-05-01' => 'Labor Day',
        ];

        $events = [
            '2025-08-11' => 'Opening of Classes',
            '2025-09-15' => 'Foundation Week Program',
            '2025-10-20' => 'Midterm Examination',
            '2025-12-15' => 'Christmas Program',
            '2026-03-09' => 'University Intramurals',
            '2026-04-20' => 'Final Examination',
            '2026-05-25' => 'Recognition and Graduation Preparation',
        ];

        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $dateString = $currentDate->toDateString();
            $dayType = 'regular';
            $attendanceCount = 0;
            $remarks = null;

            if ($currentDate->isSaturday() || $currentDate->isSunday()) {
                $dayType = 'no-class';
                $attendanceCount = 0;
                $remarks = 'Weekend';
            } elseif (isset($holidays[$dateString])) {
                $dayType = 'holiday';
                $attendanceCount = 0;
                $remarks = $holidays[$dateString];
            } elseif (isset($events[$dateString])) {
                $dayType = 'event';
                $attendanceCount = rand(350, 500);
                $remarks = $events[$dateString];
            } else {
                $dayType = 'regular';
                $attendanceCount = rand(320, 500);
            }

            SchoolDay::create([
                'date' => $dateString,
                'day_type' => $dayType,
                'attendance_count' => $attendanceCount,
                'remarks' => $remarks,
                'school_year' => '2025-2026',
            ]);

            $currentDate->addDay();
        }
    }
}
