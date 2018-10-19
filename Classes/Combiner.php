<?php
class Combiner {

    /**
     * Combiner constructor.
     * @param string $pathToDirectory
     *
     * @throws Exception
     */
    public function __construct($pathToDirectory) {
        $fileNamesArray = $this->putFilenamesInArray($pathToDirectory);
        $filesWithPathsArray = $this->setPathToFiles($fileNamesArray, $pathToDirectory);

        $this->joinFiles($filesWithPathsArray, Main::$OUTPUT);
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