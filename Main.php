<?php

class Main {
    private $googleAppName;
    private $googleCredentials;
    private $googleSecret;

    public function __construct($googleAppName, $googleCredentials, $googleSecret) {
        $this->googleAppName = $googleAppName;
        $this->googleCredentials = $googleCredentials;
        $this->googleSecret = $googleSecret;
    }

    /**
     * @param $inputPath
     *
     * @throws Exception
     */
    public function combineFiles($inputPath) {
        new Combiner($inputPath);
    }

    /**
     * @param string $fileName
     * @param string $targetEmail
     * @param string $outputPath
     */
    public function uploadAndShareFile($fileName, $targetEmail, $outputPath) {
        $googleController = new GoogleController($this->googleAppName, $this->googleCredentials, $this->googleSecret);

        $fileId = $googleController->doUploadFiles($fileName, $outputPath);
        $googleController->doShareFiles($fileId, $targetEmail);
    }
}