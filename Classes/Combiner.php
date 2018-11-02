<?php
class Combiner {
    /**
     * @param $inputPath
     * @param $outputPath
     * @param $headerPath
     *
     * @throws Exception
     */
    public function setFileArray($inputPath, $outputPath, $headerPath) {
        $fileNamesArray = $this->putFilenamesInArray($inputPath);
        $filesWithPathsArray = $this->setPathToFiles($fileNamesArray, $inputPath);

        $this->removeFirstLineInArray($filesWithPathsArray);

        $arrayWithHeader = $this->addHeaderToArray($filesWithPathsArray, $headerPath);

        $this->joinFiles($arrayWithHeader, $outputPath);
    }

    /**
     * @param array $fileArray
     */
    private function removeFirstLineInArray(array $fileArray) {
        foreach ($fileArray as $file) {
            $shell = "sed -i 1d";

            shell_exec($shell . ' "' . $file . '"');
        }
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