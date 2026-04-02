<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentClass;
use Illuminate\Support\Str;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'Class 1', 'Class 2', 'Class 3', 'Class 4', 'Class 5',
            'Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10',
            'Class 11', 'Class 12'
        ];

        foreach ($classes as $class) {
            StudentClass::updateOrCreate(
                ['slug' => Str::slug($class)],
                ['name' => $class, 'status' => 'active']
            );
        }
    }
}
