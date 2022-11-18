<?php

namespace App\Service\Member;

use App\Entity\Member;
use App\Repository\MemberRepository;
use App\Service\File\FileService;
use League\Flysystem\AdapterInterface;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\FilesystemException;
use League\Flysystem\Visibility;
use Symfony\Component\HttpFoundation\Request;

class UploadFileService
{
    private FileService $fileService;
    private MemberRepository $memberRepository;

    /**
     * @param FileService $fileService
     * @param MemberRepository $memberRepository
     */
    public function __construct(FileService $fileService, MemberRepository $memberRepository)
    {
        $this->fileService = $fileService;
        $this->memberRepository = $memberRepository;
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Member
     * @throws FilesystemException
     */
    public function uploadFile(Request $request, string $id): Member
    {
        $member = $this->memberRepository->findOneByIdOrFail($id);
        $file = $this->fileService->validateFile($request, FileService::MEMBER_INPUT_NAME);
        $this->fileService->deleteFile($member->getFilePath());

        $filName = $this->fileService->uploadFile($file, FileService::MEMBER_INPUT_NAME, Visibility::PRIVATE);


    }
}