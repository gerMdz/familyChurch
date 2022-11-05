<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZindexController extends AbstractController
{
    /**
     * @Route("/", name="app_zindex")
     */
    public function index(): Response
    {
        return $this->render('zindex/index.html.twig', [
            'controller_name' => 'ZindexController',
        ]);
    }
}
