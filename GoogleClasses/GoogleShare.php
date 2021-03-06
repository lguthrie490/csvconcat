<?php

class GoogleShare {
    private $service;
    private $fileId;

    /**
     * GoogleShare constructor.
     *
     * @param $fileId string
     * @param $client Google_Client
     */
    public function __construct($fileId, Google_Client $client) {
        $this->service = new Google_Service_Drive($client);
        $this->fileId = $fileId;
    }

    /**
     * @param string $targetEmail
     */
    public function shareFile($targetEmail) {
        $this->service->getClient()->setUseBatch(true);

        try {
            $batch = $this->service->createBatch();

            $userPermission = new Google_Service_Drive_Permission(array(
                'type' => 'user',
                'role' => 'writer',
                'emailAddress' => $targetEmail
            ));

            $request = $this->service->permissions->create(
                $this->fileId, $userPermission, array(
                    'fields' => 'id'
                )
            );

            $batch->add($request, 'user');
            $results = $batch->execute();

            foreach ($results as $result) {
                if ($result instanceof Google_Service_Exception) {
                    printf($result);
                } else {
                    printf('Permission ID: ', $result->id);
                }
            }
        } finally {
            $this->service->getClient()->setUseBatch(false);
        }
    }
}