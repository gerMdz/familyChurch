<?php

namespace App\Exception\File;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('No se encontré el archivo en el servidor');
    }
}