<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Accounts
        User::create([
            'name' => 'Super Controller',
            'email' => 'superadmin@syndicate.com',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Admin Terminal',
            'email' => 'admin@syndicate.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Syndicate Investor
        User::create([
            'name' => 'John Investor',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'syndicate',
            'status' => 'active',
        ]);

        // Teacher Account
        $teacher = User::create([
            'name' => 'Prof. Sharma',
            'email' => 'sharma@coaching.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'status' => 'active',
        ]);

        // Student Account (Linked to Teacher)
        User::create([
            'name' => 'Amit Kumar',
            'email' => 'amit@student.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'teacher_id' => $teacher->id,
            'status' => 'active',
        ]);

        // Investment Plans
        \App\Models\Plan::create([
            'title' => 'NCR Luxury Banquet Portfolio',
            'description' => 'A cluster of 5 high-yield banquet halls in prime NCR locations.',
            'sector' => 'Marriage Halls',
            'min_investment' => 500000,
            'target_irr' => 18.50,
            'status' => 'active',
        ]);

        \App\Models\Plan::create([
            'title' => 'Digital Learning Infrastructure - Pune',
            'description' => 'Implementing smart classroom technology across 15 private institutions.',
            'sector' => 'Education',
            'min_investment' => 200000,
            'target_irr' => 15.00,
            'status' => 'active',
        ]);

        // Sample Quiz (Free)
        $quiz = \App\Models\Quiz::create([
            'teacher_id' => $teacher->id,
            'title' => 'General Aptitude Beta 1.0',
            'description' => 'Comprehensive evaluation of logical reasoning and quantitative ability.',
            'price' => 0,
            'duration_minutes' => 30,
            'attempts_limit' => 3,
            'status' => 'published',
        ]);

        // Sample Questions
        $quiz->questions()->create([
            'question_text' => 'Which planet is known as the Red Planet?',
            'options' => ['Earth', 'Mars', 'Jupiter', 'Saturn'],
            'correct_option' => 1,
            'marks' => 2,
        ]);

        $quiz->questions()->create([
            'question_text' => 'What is the square root of 225?',
            'options' => ['12', '13', '15', '25'],
            'correct_option' => 2,
            'marks' => 2,
        ]);

        // Sample Quiz (Paid - Pending)
        \App\Models\Quiz::create([
            'teacher_id' => $teacher->id,
            'title' => 'Advanced Physics - Quantum Mechanics',
            'description' => 'Deep dive into particle physics and wave functions.',
            'price' => 499,
            'duration_minutes' => 60,
            'attempts_limit' => 1,
            'status' => 'pending',
        ]);
        // Comprehensive Academy Course
        $course = \App\Models\Course::create([
            'teacher_id' => $teacher->id,
            'title' => 'Digital Marketing & Strategy 2026',
            'description' => 'Master the art of digital growth, from SEO to advanced conversion optimization.',
            'price' => 0,
            'status' => 'published',
            'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800',
        ]);

        $subject = $course->subjects()->create(['title' => 'Module 1: Foundations', 'order' => 1]);
        $topic = $subject->topics()->create(['title' => '1.1 SEO Fundamentals', 'order' => 1]);
        
        $topic->contents()->create([
            'type' => 'video',
            'title' => 'The Search Algorithm Explained',
            'body' => 'https://www.youtube.com/watch?v=hF515-0Tduk',
            'order' => 1,
        ]);

        $topic->contents()->create([
            'type' => 'note',
            'title' => 'Technical SEO Checklist',
            'body' => "Essential Technical SEO Items: \n1. Robots.txt optimization \n2. Sitemaps submission \n3. Page speed benchmarks \n4. Mobile responsiveness.",
            'order' => 2,
            'attachment_path' => 'demo/seo_checklist.pdf',
        ]);

        $topic->contents()->create([
            'type' => 'test',
            'title' => 'SEO Knowledge Check',
            'quiz_id' => $quiz->id,
            'order' => 3,
        ]);

        // Auto-enroll the student
        $amit = User::where('email', 'amit@student.com')->first();
        $amit->enrolledCourses()->sync([$course->id]);
    }
}
