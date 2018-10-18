<?php
require_once __DIR__ . '/vendor/autoload.php';

// @todo autoload custom classes
require_once __DIR__ . '/Main.php';
require_once __DIR__ . '/Classes/Joins.php';
require_once __DIR__ . '/GoogleClasses/GoogleController.php';
require_once __DIR__ . '/GoogleClasses/GoogleUploader.php';
require_once __DIR__ . '/GoogleClasses/GoogleShare.php';
require_once __DIR__ . '/GoogleClasses/ClientCreator.php';

const INPUT = __DIR__ . '/Files/';
const OUTPUT = '/mnt/c/Users/Logan Guthrie/Development/code/CSVConcatPHP/Output/file.csv';

$main = new Main();

$main->uploadAndShareFile();
