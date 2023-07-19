<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AskeController extends AbstractController
{
    #[Route('/', name: 'app_aske')]
    public function index(): Response
    {
        return $this->render('aske/index.html.twig', [
            'controller_name' => 'AskeController',
        ]);
    }
}
