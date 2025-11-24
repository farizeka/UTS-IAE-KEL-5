<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample enrollment data
        Enrollment::create([
            'user_id' => 1,
            'course_id' => 1,
            'status' => 'active',
            'grade' => null,
            'notes' => 'Student is actively participating in the course',
            'enrolled_at' => now()->subDays(30),
        ]);

        Enrollment::create([
            'user_id' => 1,
            'course_id' => 2,
            'status' => 'completed',
            'grade' => 95.5,
            'notes' => 'Excellent performance throughout the course',
            'enrolled_at' => now()->subDays(90),
            'completed_at' => now()->subDays(15),
        ]);

        Enrollment::create([
            'user_id' => 1,
            'course_id' => 3,
            'status' => 'pending',
            'grade' => null,
            'notes' => 'Enrollment pending approval',
            'enrolled_at' => now()->subDays(5),
        ]);

        Enrollment::create([
            'user_id' => 1,
            'course_id' => 4,
            'status' => 'active',
            'grade' => 87.0,
            'notes' => 'Good progress, keep up the work',
            'enrolled_at' => now()->subDays(60),
        ]);

        Enrollment::create([
            'user_id' => 1,
            'course_id' => 5,
            'status' => 'cancelled',
            'grade' => null,
            'notes' => 'Student requested course cancellation',
            'enrolled_at' => now()->subDays(45),
        ]);
    }
}
