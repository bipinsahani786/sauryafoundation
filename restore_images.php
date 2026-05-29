<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;

echo "Restoring Partners...\n";
$partnerFiles = Storage::disk('public')->files('experts');
$i = 0;
foreach ($partnerFiles as $file) {
    Partner::create([
        'name' => 'Restored Partner ' . ($i + 1),
        'image_path' => $file,
        'is_active' => true,
    ]);
    $i++;
}
echo "Restored $i partners.\n";

echo "Restoring Settings Images...\n";
$settingFiles = Storage::disk('public')->files('settings');
$keys = [
    'involved_hero_image',
    'admin_qr_code',
    'about_me_top_image',
    'about_me_left_image',
    'about_me_right_image',
    'about_us_hero_image',
    'about_us_mission_image',
    'our_work_hero_image',
    'media_hero_image',
    'media_story_1_image',
    'media_story_2_image'
];

$keyIndex = 0;
foreach ($settingFiles as $file) {
    if (str_contains($file, 'lhfS6FlevACUHkPYuL8idv6kKSInvlQUXPLN5VjE') || str_contains($file, 'V2bbifq7nSzS46Tgpwr8xqXcANzZqWpUbeVBgkW9')) {
        continue;
    }
    
    if (isset($keys[$keyIndex])) {
        Setting::updateOrCreate(['key' => $keys[$keyIndex]], ['value' => $file]);
        $keyIndex++;
    }
}
echo "Restored $keyIndex settings images.\n";
echo "Done!\n";
