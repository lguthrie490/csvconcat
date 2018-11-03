<?php

class GoogleController {
    private $googleClient;
    private $appName;
    private $credentials;
    private $secret;

    public function __construct($appName, $credentials, $secret) {
        $this->appName = $appName;
        $this->credentials = $credentials;
        $this->secret = $secret;

        $this->commandLineCheck();
        $this->defineScopes();

        $client = new ClientCreator();
        $this->googleClient = $client->getClient();
    }

    /**
     * Uploads file
     * Returns file ID
     *
     * @return string
     */
    public function doUploadFiles($fileName, $outputPath) {
        $googleUploader = new GoogleUploader($this->googleClient);

        return $googleUploader->uploadFile($outputPath, $fileName);
    }


    public function doShareFiles($fileId, $targetEmail) {
        $googleShare = new GoogleShare($fileId, $this->googleClient);

        $googleShare->shareFile($targetEmail);
    }

    /**
     * Defines google drive API parameters
     *
     * For more info on scope privileges, check out:
     * https://developers.google.com/resources/api-libraries/documentation/drive/v3/php/latest/class-Google_Service_Drive.html
     *
     */
    private function defineScopes() {
        define('APPLICATION_NAME', $this->appName);
        define('CREDENTIALS_PATH', $this->credentials);
        define('CLIENT_SECRET_PATH', $this->secret);
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