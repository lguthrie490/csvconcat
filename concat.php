<?php
require_once __DIR__ . '/Main.php';
require_once __DIR__ . '/Classes/Read.php';
require_once __DIR__ . '/Classes/Joins.php';
const INPUT = __DIR__ . '/Files/';

const OUT = __DIR__ . '/Output/file.csv';

$main = new Main();

$array = $main->getReadArray();
$main->joinFiles($array, OUT);

print_r("Done, kupo.");