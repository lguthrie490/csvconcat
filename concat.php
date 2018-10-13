<?php
require_once __DIR__ . '/Main.php';
require_once __DIR__ . '/Classes/Joins.php';
const INPUT = __DIR__ . '/Files/';

const OUTPUT = __DIR__ . '/Output/file.csv';

//$main = new Main();
//
//$array = $main->getReadArray();
//$main->joinFiles($array, OUT);
//
//print_r("Done, kupo.");

$joins = new Joins();

$joins->removeFirstLine(INPUT . '/Daily_Dashboard_-_Expected_Apt_-_Scheduled_01d3d0d7-433c-455c-8fad-53968f681cd5.csv');
