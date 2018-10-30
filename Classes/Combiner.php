<?php
class Combiner {

    /**
     * Combiner constructor.
     * @param string $pathToDirectory
     * @param string $outputFilePath
     *
     * @throws Exception
     */
    public function __construct($pathToDirectory, $outputFilePath, $headerFilePath) {
        $fileNamesArray = $this->putFilenamesInArray($pathToDirectory);
        $filesWithPathsArray = $this->setPathToFiles($fileNamesArray, $pathToDirectory);

        $this->removeFirstLineInArray($filesWithPathsArray);

        $arrayWithHeader = $this->addHeaderToArray($filesWithPathsArray, $headerFilePath);

        $this->joinFiles($arrayWithHeader, $outputFilePath);
    }

    public function combineFiles() {

    }

    /**
     * @param array $fileArray
     */
    private function removeFirstLineInArray(array $fileArray) {
        foreach ($fileArray as $file) {
            $this->removeFirstLine($file);
        }
    }

    /**
     * Removes the first line of the .csv file indiscriminately
     *
     * @param string $filePath
     */
    public function removeFirstLine($filePath) {
        // Reads and deletes the first line of the csv
        $shell = 'sed -i 1d ';

        shell_exec($shell . '"' . $filePath . '"');
    }

    /**
     * @param array $files
     * @param string $outputFilePath
     *
     * @throws Exception
     */
    private function joinFiles(array $files, $outputFilePath) {

        $combinedFile = fopen($outputFilePath, "w+");

        foreach($files as $file) {
            $readFile = fopen($file, "r");
            // While not end of file being read
            while(!feof($readFile)) {
                fwrite($combinedFile, fgets($readFile));
            }
            fclose($readFile);
            unset($readFile);
        }
        fclose($combinedFile);
        unset($combinedFile);
    }

    /**
     * @param $dir string Directory to files
     *
     * @return array | boolean
     */
    private function putFilenamesInArray($dir) {
        if ($dir) {
            return array_diff(scandir($dir, 1), array('..', '.'));
        } else {
            return FALSE;
        }
    }

    /**
     * Adds .csv file containing only headers to the front of the file array
     *
     * @param array $fileArray
     * @param string $headerFilePath
     *
     * @return array
     */
    private function addHeaderToArray(array $fileArray, $headerFilePath) {
        array_unshift($fileArray, $headerFilePath);

        return $fileArray;
    }

    /**
     * @param array $files
     * @param $path
     *
     * @return array|bool
     */
    private function setPathToFiles(array $files, $path) {
        if(is_array($files)) {
            foreach ($files as &$file) {
                $file = $path . $file;
            }

            unset($file);

            return $files;
        } else {
            return FALSE;
        }
    }
}