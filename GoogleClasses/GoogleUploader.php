<?php

class GoogleUploader {
    private $filePath;
    private $service;


    public function __construct() {
        $today = date("Y-m-d");

        $client = new ClientCreator();
        $googleClient = $client->getClient();

        $this->service = new Google_service_Drive($googleClient);
    }

    /**
     * @param $pathToFile string
     *
     * @return string
     */
    public function uploadFile($pathToFile) {

        $fileMetadata = new Google_Service_Drive_DriveFile(array(
            'name' => 'CSVUPLOADTEST.csv',
            'mimeType' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ));

        $content = file_get_contents($pathToFile);

        $file = $this->service->files->create($fileMetadata, array(
            'data' => $content,
            'mimeType' => 'text/csv',
            'uploadType' => 'resumable',
            'fields' => 'id'
        ));

        return $file->id;
    }
}