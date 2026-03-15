<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'course_code' => 'BSIT',
                'course_name' => 'Bachelor of Science in Information Technology',
                'department' => 'College of Computing',
                'description' => 'Focuses on software development, networking, databases, and systems administration.',
            ],
            [
                'course_code' => 'BSCS',
                'course_name' => 'Bachelor of Science in Computer Science',
                'department' => 'College of Computing',
                'description' => 'Focuses on algorithms, programming, artificial intelligence, and software engineering.',
            ],
            [
                'course_code' => 'BSIS',
                'course_name' => 'Bachelor of Science in Information Systems',
                'department' => 'College of Computing',
                'description' => 'Focuses on integrating business processes with information systems.',
            ],
            [
                'course_code' => 'BSEMC',
                'course_name' => 'Bachelor of Science in Entertainment and Multimedia Computing',
                'department' => 'College of Computing',
                'description' => 'Focuses on digital media, animation, and game development.',
            ],
            [
                'course_code' => 'BSA',
                'course_name' => 'Bachelor of Science in Accountancy',
                'department' => 'College of Business and Accountancy',
                'description' => 'Focuses on accounting principles, auditing, and financial reporting.',
            ],
            [
                'course_code' => 'BSBA-MM',
                'course_name' => 'Bachelor of Science in Business Administration Major in Marketing Management',
                'department' => 'College of Business and Accountancy',
                'description' => 'Focuses on marketing, branding, and strategic business operations.',
            ],
            [
                'course_code' => 'BSBA-FM',
                'course_name' => 'Bachelor of Science in Business Administration Major in Financial Management',
                'department' => 'College of Business and Accountancy',
                'description' => 'Focuses on corporate finance, investment, and risk management.',
            ],
            [
                'course_code' => 'BPA',
                'course_name' => 'Bachelor of Public Administration',
                'department' => 'College of Governance',
                'description' => 'Focuses on public service, governance, and policy implementation.',
            ],
            [
                'course_code' => 'BSHM',
                'course_name' => 'Bachelor of Science in Hospitality Management',
                'department' => 'College of Hospitality and Tourism',
                'description' => 'Focuses on hotel, restaurant, and hospitality operations.',
            ],
            [
                'course_code' => 'BSTM',
                'course_name' => 'Bachelor of Science in Tourism Management',
                'department' => 'College of Hospitality and Tourism',
                'description' => 'Focuses on tourism operations, travel services, and destination planning.',
            ],
            [
                'course_code' => 'BEED',
                'course_name' => 'Bachelor of Elementary Education',
                'department' => 'College of Education',
                'description' => 'Focuses on teaching strategies for elementary learners.',
            ],
            [
                'course_code' => 'BSED-ENG',
                'course_name' => 'Bachelor of Secondary Education Major in English',
                'department' => 'College of Education',
                'description' => 'Focuses on English instruction, literature, and communication.',
            ],
            [
                'course_code' => 'BSED-MATH',
                'course_name' => 'Bachelor of Secondary Education Major in Mathematics',
                'department' => 'College of Education',
                'description' => 'Focuses on mathematics instruction and problem-solving pedagogy.',
            ],
            [
                'course_code' => 'BSED-SCI',
                'course_name' => 'Bachelor of Secondary Education Major in Science',
                'department' => 'College of Education',
                'description' => 'Focuses on scientific concepts and science education methods.',
            ],
            [
                'course_code' => 'BSCRIM',
                'course_name' => 'Bachelor of Science in Criminology',
                'department' => 'College of Criminal Justice Education',
                'description' => 'Focuses on criminal law, investigation, and law enforcement.',
            ],
            [
                'course_code' => 'BSN',
                'course_name' => 'Bachelor of Science in Nursing',
                'department' => 'College of Health Sciences',
                'description' => 'Focuses on patient care, clinical practice, and nursing ethics.',
            ],
            [
                'course_code' => 'BSMID',
                'course_name' => 'Bachelor of Science in Midwifery',
                'department' => 'College of Health Sciences',
                'description' => 'Focuses on maternal care, childbirth support, and women’s health.',
            ],
            [
                'course_code' => 'BSCE',
                'course_name' => 'Bachelor of Science in Civil Engineering',
                'department' => 'College of Engineering',
                'description' => 'Focuses on structural design, construction, and infrastructure.',
            ],
            [
                'course_code' => 'BSEE',
                'course_name' => 'Bachelor of Science in Electrical Engineering',
                'department' => 'College of Engineering',
                'description' => 'Focuses on electrical systems, power, and industrial applications.',
            ],
            [
                'course_code' => 'BSME',
                'course_name' => 'Bachelor of Science in Mechanical Engineering',
                'department' => 'College of Engineering',
                'description' => 'Focuses on machines, thermodynamics, and manufacturing systems.',
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['course_code' => $course['course_code']],
                $course
            );
        }
    }
}
