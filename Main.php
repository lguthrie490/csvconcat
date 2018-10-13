<?php

class Main {

    public function __construct() {
        $this->commandLineCheck();
    }

    /**
     * Defines google drive API parameters
     */
    private function defineScopes() {
        define('APPLICATION_NAME', Main::$NAME);
        define('CREDENTIALS_PATH', Main::$CREDENTIALS);
        define('CLIENT_SECRET_PATH', Main::$SECRET);
        define('SCOPES', implode(' ', array(
                Google_Service_Drive::DRIVE)
        ));
    }

    private function commandLineCheck() {
        if (php_sapi_name() != 'cli') {
            throw new Exception('This application must be run on the command line.');
        }
    }

    /**
     * @return array|bool
     */
    public function getReadArray() {
        $read = new Read();

        return $read->readFilesAndSetPath(INPUT);
    }

    public function joinFiles(array $fileArray, $output) {
        $joins = new Joins();

        $joins->joinFiles($fileArray, $output);
    }

    public function concatCSV() {
        $dir = __DIR__;

        $this->getReadArray($dir);
    }
}