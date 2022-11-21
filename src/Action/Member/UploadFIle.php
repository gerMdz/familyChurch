<?php

namespace App\Action\Member;

use App\Entity\Member;
use App\Service\Member\UploadFileService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UploadFIle
{
    private UploadFileService $uploadFileService;

    /**
     * @param UploadFileService $uploadFileService
     */
    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

    public function __invoke(Request $request, string $id):Member
    {
        return $this->uploadFileService->uploadFile($request, $id);
    }

}