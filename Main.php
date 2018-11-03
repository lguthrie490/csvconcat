<?php

class Main {
    private $root;
    private $googleAppName;
    private $googleCredentials;
    private $googleSecret;

    /**
     * Main constructor.
     *
     * @param $root
     * @param $googleAppName
     * @param $googleCredentials
     * @param $googleSecret
     */
    public function __construct($root, $googleAppName, $googleCredentials, $googleSecret) {
        $this->root = $root;
        $this->googleAppName = $googleAppName;
        $this->googleCredentials = $googleCredentials;
        $this->googleSecret = $googleSecret;
    }

    public function combineCsvFiles() {
        $fileOps = new FileOperations($this->root);
        $combiner = new Combiner();

        $combiner->joinFiles($fileOps->getInputArray(), $fileOps->getOutput());
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