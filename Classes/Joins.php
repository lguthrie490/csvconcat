<?php
class Joins {

    /**
     * @param array $files
     * @param $result
     *
     * @throws Exception
     */
    function joinFiles(array $files, $result) {

        $this->checkIfArray($files);

        $wH = fopen($result, "w+");

        foreach($files as $file) {
            $fh = fopen($file, "r");
            while(!feof($fh)) {
                fwrite($wH, fgets($fh));
            }
            fclose($fh);
            unset($fh);
        }
        fclose($wH);
        unset($wH);
    }

    /**
     * @param $files
     *
     * @throws Exception
     */
    function checkIfArray($files) {
        if(!is_array($files)) {
            throw new Exception('`$files` must be an array');
        }
    }
}