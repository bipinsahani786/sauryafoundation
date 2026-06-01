<?php
$log = file_get_contents('storage/logs/laravel.log');
$lines = explode("\n", $log);
foreach($lines as $line) {
    if (strpos($line, '[2026-06-01') !== false && strpos($line, 'local.ERROR') !== false) {
        echo substr($line, 0, 150) . "...\n";
    }
}
