<?php
class Combiner {
    private $pathToDirectory;

    public function __construct($pathToDirectory) {
        $this->pathToDirectory = $pathToDirectory;

        $fileNamesArray = $this->putFilenamesInArray($this->pathToDirectory);
        $filesWithPathsArray = $this->setPath($fileNamesArray, $this->pathToDirectory);

    }

    /**
     * @param array $files
     * @param $result
     *
     * @throws Exception
     */
    private function joinFiles(array $files, $result) {

        $combinedFile = fopen($result, "w+");

        $this->checkIfArray($files);

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
     * @todo error handling
     *
     * @param $dir string Directory files to be concatted are located in
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
     * @todo error handling
     *
     * @param array $files
     * @param $path
     *
     * @return array|bool
     */
    private function setPath(array $files, $path) {
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