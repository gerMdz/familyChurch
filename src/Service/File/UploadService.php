<?php

namespace App\Service\File;

use Aws\Result;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class UploadService
{
    private string $key;
    private string $secret;
    private string $region;
    private string $bucketName;
    private string $bucketFolder;

    /**
     * @param string $key
     * @param string $secret
     * @param string $region
     * @param string $bucketName
     * @param string $bucketFolder
     */
    public function __construct(string $key,string $secret, string $region, string $bucketName, string $bucketFolder )
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->region = $region;
        $this->bucketName = $bucketName;
        $this->bucketFolder = $bucketFolder;
    }

    public function subirImagen($fileName,$path): Result
    {
        $opciones = [
            'region' => $this->region,
            'version' => 'latest',
            'credentials' => [
                'key' => $this->key,
                'secret' => $this->secret,
            ],
        ];
        $client = new S3Client($opciones);
        try {
            $result = $client->putObject([
                'Bucket' => $this->bucketName,
                'Key' => $this->bucketFolder.'/'.$fileName,
                'SourceFile' => $path
            ]);
        } catch (S3Exception $e) {
            $result = $e->getResult();
        }
        return $result;

}

}