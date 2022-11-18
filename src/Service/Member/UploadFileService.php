<?php

namespace App\Service\Member;

use App\Entity\Member;
use Symfony\Component\HttpFoundation\Request;

class UploadFileService
{
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Member
     */
    public function uploadFile(Request $request, string $id):Member
    {

    }
}