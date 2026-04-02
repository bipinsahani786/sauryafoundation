<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Testimonial;
use App\Models\IndustryExpert;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Experts
        IndustryExpert::create([
            'name' => 'Dr. Amit Sharma',
            'designation' => 'Strategic Advisor',
            'bio' => 'Former director at Ministry of Infrastructure with 25+ years in policy framework.',
            'image' => 'experts/expert-1.png',
            'linkedin_url' => 'https://linkedin.com',
            'order' => 0,
        ]);

        IndustryExpert::create([
            'name' => 'Sarah Jenkins',
            'designation' => 'Chief Operations Officer',
            'bio' => 'Expert in hospitality management and large-scale banquet operations.',
            'image' => 'experts/expert-2.png',
            'linkedin_url' => 'https://linkedin.com',
            'order' => 1,
        ]);

        IndustryExpert::create([
            'name' => 'Vikram Rao',
            'designation' => 'Chief Investment Officer',
            'bio' => 'Chartered Accountant with focus on distressed asset restructuring.',
            'image' => 'experts/expert-3.png',
            'linkedin_url' => 'https://linkedin.com',
            'order' => 2,
        ]);

        // Testimonials
        Testimonial::create([
            'name' => 'Rahul Verma',
            'designation' => 'Tech Entrepreneur',
            'content' => 'The transparency is what sold me. Being able to track the actual bookings of the marriage hall I invested in through my personal panel is revolutionary.',
            'rating' => 5,
            'image' => 'testimonials/review-1.png',
        ]);

        Testimonial::create([
            'name' => 'Anita Desai',
            'designation' => 'HNI Investor',
            'content' => 'Institutional real estate has always been my dream. Shaurya made it possible with just a fraction of the capital. Their asset selection process is unparalleled.',
            'rating' => 5,
            'image' => 'testimonials/review-2.png',
        ]);

        Testimonial::create([
            'name' => 'Suresh Nair',
            'designation' => 'Finance Consultant',
            'content' => 'The digital coaching model is a genius addition to the portfolio. Combining high-growth tech with infrastructure stability is brilliant asset allocation.',
            'rating' => 5,
            'image' => 'testimonials/review-3.png',
        ]);
    }
}
