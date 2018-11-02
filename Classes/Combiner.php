<?php
class Combiner {

    /**
     * @param array $inputFiles
     * @param string $outputFilePath
     *
     * @throws Exception
     */
    public function joinFiles(array $inputFiles, $outputFilePath) {

        $combinedFile = fopen($outputFilePath, "w+");

        foreach($inputFiles as $file) {
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
}