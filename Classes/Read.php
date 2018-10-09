<?php

class Read {

    /**
     * @param $path string
     *
     * @return array|bool
     */
    public function readFilesAndSetPath($path) {
        $files = $this->readFiles($path);

        return $this->addPath($files, $path);
    }

    /**
     * @todo error handling for type checking
     *
     * @param $dir string Directory files to be concatted are located in
     *
     * @return array | boolean
     */
    public function readFiles($dir) {
        if ($dir) {
            return array_diff(scandir($dir, 1), array('..', '.'));
        } else {
            return FALSE;
        }
    }

    /**
     * @todo error handling for type checking
     *
     * @param array $files
     * @param $path
     *
     * @return array|bool
     */
    private function addPath(array $files, $path) {
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