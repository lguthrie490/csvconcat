<?php

class Main {
    public static $OUTPUT = '/mnt/c/Users/Logan Guthrie/Development/code/CSVConcatPHP/Output/file.csv';

    public function uploadAndShareFile() {
        $googleController = new GoogleController();

        $googleController->doShareFiles('1POVVj5btF7PRA7Uv7P1v4DgDEkO1MA6H-SeHHlFmbEk');
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