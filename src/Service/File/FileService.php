<?php

namespace App\Service\File;





use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FileService
{
    public const MEMBER_INPUT_NAME = 'file';


    private LoggerInterface $logger;
    private string $mediaPath;

    public function __construct(Filesystem $defaultStorage, LoggerInterface $logger, string $mediaPath)
    {
        $this->defaultStorage = $defaultStorage;
        $this->logger = $logger;
        $this->mediaPath = $mediaPath;
    }

    /**
     * @throws FilesystemException
     */
    public function uploadFile(UploadedFile $file, string $prefix, string $visibility): string
    {
        $fileName = \sprintf('%s/%s.%s', $prefix, \sha1(\uniqid()), $file->guessExtension());

        $this->defaultStorage->writeStream(
            $fileName,
            \fopen($file->getPathname(), 'r'),
            compact('visibility')
        );

        return $fileName;
    }

    public function downloadFile(string $path): ?string
    {
        try {
            return $this->defaultStorage->read($path);
        } catch (FileNotFoundException $e) {
            throw new \App\Exception\File\FileNotFoundException();
        }
    }

    public function validateFile(Request $request, string $inputName): UploadedFile
    {
        if (null === $file = $request->files->get($inputName)) {
            throw new BadRequestHttpException(\sprintf('Cannot get file with input name %s', $inputName));
        }

        return $file;
    }

    public function deleteFile(?string $path): void
    {
        try {
            if (null !== $path) {
                $this->defaultStorage->delete($path);
            }
        } catch (\Exception $e) {
            $this->logger->warning(\sprintf('File %s not found in the storage', $path));
        }
    }
}