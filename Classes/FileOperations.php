<?php

class FileOperations {
    private $output;
    private $input;
    private $header;
    private $inputArray;

    /**
     * FileOperations constructor.
     * Pass in the root directory of the application
     *
     * @param string $root
     */
    public function __construct($root) {
        $this->setOutput($root);
        $this->setInput($root);
        $this->setHeader($root);

        $this->setInputArray();
    }

    /**
     * @return string
     */
    public function getOutput() {
        return $this->output;
    }

    /**
     * @return string
     */
    public function getInput() {
        return $this->input;
    }

    /**
     * @return array
     */
    public function getInputArray() {
        return $this->inputArray;
    }

    /**
     * Sets the name of the output file for the month
     */
    private function setOutput($root) {
        $today = date('m-Y');

        $this->output = $root . '/Output/' . 'ExpectedAppointmentDashboard-' . $today . '.csv';
    }

    private function setInput($root) {
        $this->input = $root . '/Files/';
    }

    private function setHeader($root) {
        $this->header = $root . '/Header/header.csv';
    }

    private function setInputArray() {
        $inputFilenameArray = $this->getInputFilenameArray();
        $pathedArray = $this->addPathsToInputArray($inputFilenameArray);

        $this->removeHeadersFromFiles($pathedArray);

        $this->inputArray = $this->addHeaderToFileArray($pathedArray);
    }

    /**
     * Checks to see if this month's file has been created and if not creates it
     *
     * @throws Exception
     */
    public function createOutputFile() {
        if (file_exists($this->output)) {
            throw new Exception('Output file already exists, try deleting the current month\'s .csv and try again');
        } else {
            fopen($this->output, 'w') or die('Cannot create file');
        }

    }

    /**
     * Takes an array of files and deletes them
     *
     * @param array $filesArray
     */
    public function deleteFilesAfterCompleting(array $filesArray) {
        foreach ($filesArray as $file) {
            unlink($file);
        }
    }

    /**
     * @return array | boolean
     */
    private function getInputFilenameArray() {
        if ($this->input) {
            return array_diff(scandir($this->input, 1), array('..', '.'));
        } else {
            return FALSE;
        }
    }

    /**
     * @param array $inputFilenameArray
     *
     * @return array|bool
     */
    private function addPathsToInputArray(array $inputFilenameArray) {
        if(is_array($inputFilenameArray)) {
            foreach ($inputFilenameArray as &$file) {
                $file = $this->input . $file;
            }

            unset($file);

            return $inputFilenameArray;
        } else {
            return FALSE;
        }
    }

    /**
     * @param array $fileArray
     */
    private function removeHeadersFromFiles(array $fileArray) {
        foreach ($fileArray as $file) {
            $shell = "sed -i 1d";

            shell_exec($shell . ' "' . $file . '"');
        }
    }

    /**
     * @param array $fileArray
     *
     * @return array
     */
    private function addHeaderToFileArray(array $fileArray) {
        array_unshift($fileArray, $this->header);

        return $fileArray;
    }
}