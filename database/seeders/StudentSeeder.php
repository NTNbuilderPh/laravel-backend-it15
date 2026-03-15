<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $courseIds = Course::pluck('id')->toArray();

        if (empty($courseIds)) {
            return;
        }

        $cities = [
            'Tagum City',
            'Panabo City',
            'Island Garden City of Samal',
            'Santo Tomas',
            'Asuncion',
            'Kapalong',
            'New Corella',
            'Braulio E. Dujali',
            'Carmen',
            'Talaingod',
            'San Isidro',
        ];

        $yearLevels = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
        $genders = ['Male', 'Female'];
        $statuses = ['Enrolled', 'Enrolled', 'Enrolled', 'Enrolled', 'Irregular'];

        for ($i = 1; $i <= 500; $i++) {
            Student::create([
                'student_id' => '2025-'.str_pad($i, 5, '0', STR_PAD_LEFT),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'middle_name' => $faker->optional(0.7)->lastName,
                'gender' => $faker->randomElement($genders),
                'birthdate' => $faker->dateTimeBetween('-25 years', '-16 years')->format('Y-m-d'),
                'address' => $faker->streetAddress,
                'province' => 'Davao del Norte',
                'city' => $faker->randomElement($cities),
                'year_level' => $faker->randomElement($yearLevels),
                'course_id' => $faker->randomElement($courseIds),
                'enrollment_date' => $faker->dateTimeBetween('2025-06-01', '2025-10-31')->format('Y-m-d'),
                'status' => $faker->randomElement($statuses),
                'school_year' => '2025-2026',
            ]);
        }
    }
}
