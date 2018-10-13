<?php

class GoogleUploader {
    private $fileDetails;

    public function __construct() {
        $today = date("Y-m-d");

        $this->fileDetails = array(
            'name' => 'CSV Report ' . $today,
            'mimeType' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
    }

    public function uploadFile($pathToFile) {
        $driveService = new Google_Service_Drive();

        $fileMetadata = new Google_Service_Drive_DriveFile($this->fileDetails);

        $content = file_get_contents($pathToFile);

        $file = $driveService->files->create($fileMetadata, array(
            'data' => $content,
            'mimeType' => 'text/csv',
            'uploadType' => 'resumable',
            'fields' => 'id'
        ));

        printf("File ID: %s\n, $file->id");
    }
}