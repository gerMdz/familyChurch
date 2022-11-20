<?php

namespace App\Exception\Member;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MemberNotFoundException extends NotFoundHttpException
{

    private const MESSAGE = 'No se encontró al miembro de la iglesia buscado';
    private const MESSAGE_PATH = 'No se encontró el archivo buscado';

    public static function fromId(string $id): self
    {
        throw new self(sprintf(self::MESSAGE, $id));
    }

    public static function fromFilePath(string $filePath):self
    {
        throw new self(sprintf(self::MESSAGE_PATH, $filePath));
    }
}