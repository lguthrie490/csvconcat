<?php
class Joins {



    public function removeFirstLine($filePath) {
        $file = fopen($filePath, 'r');

        $data = array();

        while (($data_tmp = fgetcsv($file, 1000, ",")) !== FALSE) {
            $data[] = $data_tmp;
        }

        fclose($file);

        array_shift($data);

        $file = fopen('words.csv', 'w');

        foreach($data as $d){
            fputcsv($file,$d);
        }

        fclose($file);
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