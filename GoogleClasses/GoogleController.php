<?php

class GoogleController {
    private $service;
    public static $ENCODING = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
    public static $FILE_PATH = "C:\Users\Logan Guthrie\Development\code\CSVConcatPHP";
    private static $NAME = "CSV Concatenation";
    private static $CREDENTIALS = "C:\Users\Logan Guthrie\Development\code\CSVConcatPHP\keys";
    private static $SECRET = "C:\Users\Logan Guthrie\Development\code\CSVConcatPHP\keys\client_secret_228731879602-u4gitai3qr1d59rcdbrpohht99fm1lil.apps.googleusercontent.com";

    public function __construct() {
        $this->commandLineCheck();
        $this->defineScopes();

        $client = new ClientCreator();
        $googleClient = $client->getClient();

        $this->service = new Google_Service_Drive($googleClient)
    }
    /**
     * Defines google drive API parameters
     */
    private function defineScopes() {
        define('APPLICATION_NAME', GoogleController::$NAME);
        define('CREDENTIALS_PATH', GoogleController::$CREDENTIALS);
        define('CLIENT_SECRET_PATH', GoogleController::$SECRET);
        define('SCOPES', implode(' ', array(
                Google_Service_Drive::DRIVE)
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