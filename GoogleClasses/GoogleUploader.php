<?php

class GoogleUploader {
    private $service;

    /**
     * GoogleUploader constructor.
     *
     * @param Google_Client $client
     */
    public function __construct(Google_Client $client) {
        $this->service = new Google_service_Drive($client);
    }

    /**
     * @todo Change upload name
     * @param $pathToFile string
     * @param string $fileName
     *
     * @return string Google Drive File ID
     */
    public function uploadFile($pathToFile, $fileName) {

        $fileMetadata = new Google_Service_Drive_DriveFile(array(
            'name' => $fileName,
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