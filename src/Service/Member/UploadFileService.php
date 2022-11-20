<?php

namespace App\Service\Member;

use App\Entity\Member;
use App\Repository\MemberRepository;
use App\Service\File\FileService;
use App\Service\File\UploadService;
use Aws\Result;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;

class UploadFileService
{

    private UploadService $uploadService;
    private MemberRepository $memberRepository;


    /**
     * @param UploadService $uploadService
     * @param MemberRepository $memberRepository
     */
    public function __construct(UploadService $uploadService, MemberRepository $memberRepository)
    {
        $this->uploadService = $uploadService;
        $this->memberRepository = $memberRepository;
    }


    public function uploadFile(Request $request,$id): Member
    {

        $member = $this->memberRepository->findOneByIdOrFail($id);

        $files = $request->files;
        $foto = $files->get('file');
        $fileName = Uuid::uuid4()->toString()."-".$foto->getClientOriginalName();
        $destino = 'image/photos';
        $foto->move($destino, $fileName);
        $path = $destino.'/'.$fileName;

        $result = $this->uploadService->subirImagen($fileName, $path);

        if ($result['@metadata']['statusCode'] == 200) {
            $pathUrl = $result['@metadata']['effectiveUri'];
        } else {
            return json_decode($result);

        }
        unlink($path);

        $member->setFilePath($pathUrl);
        $this->memberRepository->add($member, true);

        return $member;

    }


}