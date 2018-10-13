<?php

class Main {

    public function __construct() {
        $this->commandLineCheck();
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