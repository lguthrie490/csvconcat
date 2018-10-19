<?php
// Autoload Google Libraries
require_once __DIR__ . '/vendor/autoload.php';

// @todo autoload custom classes
require_once __DIR__ . '/Main.php';
require_once __DIR__ . '/Classes/Combiner.php';
require_once __DIR__ . '/GoogleClasses/GoogleController.php';
require_once __DIR__ . '/GoogleClasses/GoogleUploader.php';
require_once __DIR__ . '/GoogleClasses/GoogleShare.php';
require_once __DIR__ . '/GoogleClasses/ClientCreator.php';

// Google Credentialing
const GOOGLE_APPNAME = 'CSV Concat';
const GOOGLE_CREDENTIALS = __DIR__ . '/keys/drive.googleapis.com-csv-concatenation-new.json';
CONST GOOGLE_SECRET = __DIR__ . '/keys/client_secret_228731879602-u4gitai3qr1d59rcdbrpohht99fm1lil.apps.googleusercontent.com.json';

// File Paths
const INPUT = __DIR__ . '/Files/';
const OUTPUT = __DIR__ . '/Output/file.csv';

// Set the name of the file to be uploaded to google drive
const FILENAME = 'that.csv';
const EMAIL = 'lguthrie@acuityeyegroup.com';

$main = new Main(GOOGLE_APPNAME, GOOGLE_CREDENTIALS, GOOGLE_SECRET);

$main->combineFiles(INPUT, OUTPUT);
$main->uploadAndShareFile(FILENAME, EMAIL, OUTPUT);
