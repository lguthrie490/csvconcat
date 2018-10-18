<?php

class GoogleController {
    private $googleUploader;

    public static $ENCODING = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
    public static $FILE_PATH = "/mnt/c/Users/Logan Guthrie/Development/code/CSVConcatPHP/";
    private static $NAME = "CSV Concatenation";
    private static $CREDENTIALS = "/mnt/c/Users/Logan Guthrie/Development/code/CSVConcatPHP/keys/drive.googleapis.com-csv-concatenation-new.json";
    private static $SECRET = "/mnt/c/Users/Logan Guthrie/Development/code/CSVConcatPHP/keys/client_secret_228731879602-u4gitai3qr1d59rcdbrpohht99fm1lil.apps.googleusercontent.com.json";

    public function __construct() {
        $this->commandLineCheck();
        $this->defineScopes();

        $this->googleUploader = new GoogleUploader();
    }

    /**
     * Uploads file
     * Returns file ID
     *
     * @return string
     */
    public function doUploadFiles() {
        return $this->googleUploader->uploadFile(Main::$OUTPUT);
    }

    public function doShareFiles($fileId) {
        $googleShare = new GoogleShare($fileId);

        $googleShare->shareFile('lguthrie@acuityeyegroup.com');
    }

    /**
     * Defines google drive API parameters
     *
     * For more info on scope privileges, check out:
     * https://developers.google.com/resources/api-libraries/documentation/drive/v3/php/latest/class-Google_Service_Drive.html
     *
     */
    private function defineScopes() {
        define('APPLICATION_NAME', GoogleController::$NAME);
        define('CREDENTIALS_PATH', GoogleController::$CREDENTIALS);
        define('CLIENT_SECRET_PATH', GoogleController::$SECRET);
        define('SCOPES', implode(' ', array(
                Google_Service_Drive::DRIVE
            )
        ));
    }

    /**
     * Makes sure you're running this from the command line
     */
    private function commandLineCheck() {
        if (php_sapi_name() != 'cli') {
            throw new Exception('This application must be run on the command line.');
        }
    }

    /**
     * Deletes all xlsx files in the /google/ directory
     */
    private function deleteOldFiles() {
        $directoryPath = Main::$FILE_PATH . "*.xlsx";

        // requires array for second param, thus glob()
        array_map('unlink', glob($directoryPath));
    }
}