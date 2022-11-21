<?php

namespace App\Exception\File;

use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;

class FileNotAllowException extends UnsupportedMediaTypeHttpException
{
    public function __construct()
    {
        parent::__construct('Tipo de imagen no permitido');
    }
}
