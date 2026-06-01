<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = App\Models\User::where('role', 'student')->first();
echo 'Student ID: ' . ($u ? $u->id : 'none') . ', Class: ' . ($u ? ($u->class_id ?? 'null') : 'none') . PHP_EOL;

$materials = App\Models\StudyMaterial::all();
echo 'Total Materials: ' . $materials->count() . PHP_EOL;
foreach ($materials as $m) {
    echo 'Material ID: ' . $m->id . ', Class: ' . ($m->class_id ?? 'null') . ', Is Global: ' . $m->is_global . ', Teacher: ' . ($m->teacher_id ?? 'null') . PHP_EOL;
}
