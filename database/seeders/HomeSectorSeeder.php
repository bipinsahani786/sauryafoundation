<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors = [
            [
                'title' => 'Education',
                'slug' => 'education',
                'icon' => 'fas fa-graduation-cap',
                'description' => 'Empowering the next generation through state-of-the-art educational infrastructure and student-centric learning hubs.',
                'content' => '<h3>Building the Future of Education</h3><p>We invest in building smart classrooms, digital libraries, and modern school campuses that make quality education accessible to everyone. Our focus is on creating environments that foster innovation and holistic growth.</p><ul><li>Smart Classroom Infrastructure</li><li>Vocational Training Centers</li><li>Scholarship Support Programs</li></ul>',
                'image_path' => 'home_sectors/education.png',
                'tag' => 'Social Impact',
                'order' => 1,
                'stats' => ['yield' => 'High', 'asset_class' => 'Social', 'transparency' => '100%', 'exit_window' => 'Ongoing'],
            ],
            [
                'title' => 'Social Welfare',
                'slug' => 'social-welfare',
                'icon' => 'fas fa-hands-helping',
                'description' => 'Comprehensive community support programs designed to uplift the marginalized and ensure basic human dignity for all.',
                'content' => '<h3>Driving Social Transformation</h3><p>Our social welfare initiatives target the root causes of poverty and inequality. We work with local communities to implement sustainable development projects that provide immediate relief and long-term stability.</p>',
                'image_path' => 'home_sectors/social_welfare.png',
                'tag' => 'Community',
                'order' => 2,
                'stats' => ['yield' => 'Impact', 'asset_class' => 'Welfare', 'transparency' => 'Verified', 'exit_window' => 'Perpetual'],
            ],
            [
                'title' => 'Anath Ashram (Old Age Home)',
                'slug' => 'anath-ashram',
                'icon' => 'fas fa-home',
                'description' => 'Providing a dignified and loving environment for the elderly and orphaned, ensuring they feel valued and cared for.',
                'content' => '<h3>A Home Away From Home</h3><p>Our Anath Ashram and Old Age Homes are designed to provide more than just shelter. We offer a community of care, medical support, and emotional well-being for those who need it most.</p>',
                'image_path' => 'home_sectors/anath_ashram.png',
                'tag' => 'Compassion',
                'order' => 3,
                'stats' => ['yield' => 'Blessings', 'asset_class' => 'Residential', 'transparency' => 'Open', 'exit_window' => 'Life-long'],
            ],
            [
                'title' => 'Community Hall',
                'slug' => 'community-hall',
                'icon' => 'fas fa-users-viewfinder',
                'description' => 'Modern, multi-purpose spaces where communities come together to celebrate, learn, and grow.',
                'content' => '<h3>The Heart of the Community</h3><p>Our community halls serve as vibrant hubs for social gatherings, workshops, and local events. Built with modern amenities, they are the go-to spaces for fostering community spirit.</p>',
                'image_path' => 'home_sectors/community_hall.png',
                'tag' => 'Public Asset',
                'order' => 4,
                'stats' => ['yield' => 'Self-Sustain', 'asset_class' => 'Commercial', 'transparency' => 'Public', 'exit_window' => 'Fixed'],
            ],
            [
                'title' => 'Skill Development Program',
                'slug' => 'skill-development',
                'icon' => 'fas fa-microchip',
                'description' => 'Bridging the skill gap by providing market-ready vocational training and certifications to the youth.',
                'content' => '<h3>Empowering through Skills</h3><p>In a rapidly changing job market, we equip individuals with the technical and soft skills needed to succeed. Our programs are industry-linked and focus on immediate employability.</p>',
                'image_path' => 'home_sectors/skill_development.png',
                'tag' => 'Economic Growth',
                'order' => 5,
                'stats' => ['yield' => 'Job Ready', 'asset_class' => 'Human Cap', 'transparency' => 'Audit', 'exit_window' => 'Annual'],
            ],
            [
                'title' => 'Women Empowerment',
                'slug' => 'women-empowerment',
                'icon' => 'fas fa-hand-holding-heart',
                'description' => 'Fostering independence and leadership through financial literacy, entrepreneurship training, and legal support for women.',
                'content' => '<h3>Unleashing Potential</h3><p>We believe that when you empower a woman, you empower a nation. Our programs provide the resources, mentorship, and support systems women need to lead and succeed.</p>',
                'image_path' => 'home_sectors/women_empowerment.png',
                'tag' => 'Equality',
                'order' => 6,
                'stats' => ['yield' => 'Multiplier', 'asset_class' => 'Social', 'transparency' => 'Traceable', 'exit_window' => 'Generational'],
            ],
            [
                'title' => 'Environmental Protection',
                'slug' => 'environmental-protection',
                'icon' => 'fas fa-seedling',
                'description' => 'Protecting our planet through tree plantation drives, waste management solutions, and renewable energy adoption.',
                'content' => '<h3>A Greener Tomorrow</h3><p>We are dedicated to preserving the environment for future generations. Our projects focus on restoring ecosystems and promoting sustainable living practices in urban and rural areas.</p>',
                'image_path' => 'home_sectors/environmental.png',
                'tag' => 'Sustainability',
                'order' => 7,
                'stats' => ['yield' => 'Green', 'asset_class' => 'Natural', 'transparency' => 'Public', 'exit_window' => 'Decades'],
            ],
            [
                'title' => 'Child Welfare',
                'slug' => 'child-welfare',
                'icon' => 'fas fa-baby-carriage',
                'description' => 'Ensuring a bright future for every child through nutrition, healthcare, and protection from exploitation.',
                'content' => '<h3>Nurturing Every Child</h3><p>Our child welfare programs provide a safety net for children in need. We focus on early childhood development, protection, and ensuring every child has the opportunity to dream.</p>',
                'image_path' => 'home_sectors/child_welfare.png',
                'tag' => 'Future First',
                'order' => 8,
                'stats' => ['yield' => 'Nurture', 'asset_class' => 'Human Cap', 'transparency' => 'Strict', 'exit_window' => 'Ongoing'],
            ],
            [
                'title' => 'Health and Medical',
                'slug' => 'health-and-medical',
                'icon' => 'fas fa-stethoscope',
                'description' => 'Direct medical aid, rural health clinics, and emergency response systems to ensure healthcare for the underserved.',
                'content' => '<h3>Accessible Healthcare</h3><p>We bring institutional healthcare to those who cannot afford or access it. From mobile clinics to emergency support, our goal is to ensure that health is a right, not a privilege.</p>',
                'image_path' => 'home_sectors/health.png',
                'tag' => 'Life Saving',
                'order' => 9,
                'stats' => ['yield' => 'Vital', 'asset_class' => 'Medical', 'transparency' => 'Live', 'exit_window' => 'Immediate'],
            ],
        ];

        foreach ($sectors as $sector) {
            \App\Models\HomeSector::updateOrCreate(['slug' => $sector['slug']], $sector);
        }
    }
}
