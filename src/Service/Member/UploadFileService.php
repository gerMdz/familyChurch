<?php

namespace App\Service\Member;

use App\Entity\Member;
use App\Exception\File\FileNotAllowException;
use App\Repository\MemberRepository;
use App\Service\File\FileService;
use App\Service\File\UploadService;
use Aws\Result;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use http\Exception\BadMessageException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UploadFileService
{

    private UploadService $uploadService;
    private MemberRepository $memberRepository;
    private ValidatorInterface $validator;


    /**
     * @param UploadService $uploadService
     * @param MemberRepository $memberRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(UploadService $uploadService, MemberRepository $memberRepository, ValidatorInterface $validator)
    {
        $this->uploadService = $uploadService;
        $this->memberRepository = $memberRepository;
        $this->validator = $validator;
    }


    public function uploadFile(Request $request,$id): Member
    {

        $member = $this->memberRepository->findOneByIdOrFail($id);

        $files = $request->files;
        $foto = $files->get('file');

        $violations = $this->validator->validate(
            $foto,
            [
                new File([
                    'maxSize' => '10M',
                    'mimeTypes' => [
                        'image/*',
                    ]
                ])
            ]
        );
        if ($violations->count() > 0) {
            throw new FileNotAllowException();
        }

        $fileName = Uuid::uuid4()->toString()."-".$foto->getClientOriginalName();
        $destino = 'image/photos';
        $foto->move($destino, $fileName);
        $path = $destino.'/'.$fileName;

        $result = $this->uploadService->subirImagen($fileName, $path);

        if ($result['@metadata']['statusCode'] == 200) {
            $pathUrl = $result['@metadata']['effectiveUri'];
        } else {
            throw new BadMessageException();

        }
        unlink($path);

        $member->setFilePath($pathUrl);
        $this->memberRepository->add($member, true);

        return $member;




    }


}