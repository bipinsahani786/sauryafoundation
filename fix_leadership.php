<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Partner;
use App\Models\IndustryExpert;
use Illuminate\Support\Facades\Storage;

echo "Fixing Leadership (Experts)...\n";

// Clear out the mistakenly created partners
Partner::truncate();
echo "Cleared Partner table.\n";

// Clear out the broken IndustryExperts
IndustryExpert::truncate();
echo "Cleared IndustryExpert table.\n";

$expertFiles = Storage::disk('public')->files('experts');
$i = 0;
foreach ($expertFiles as $file) {
    IndustryExpert::create([
        'name' => 'Expert ' . ($i + 1),
        'designation' => 'Leadership Role',
        'bio' => 'Experienced leader in the foundation.',
        'image' => $file,
        'order' => $i,
    ]);
    $i++;
}

echo "Created $i IndustryExpert records.\n";
echo "Done!\n";
