<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Asked;
use App\Form\AskedType;

class AskeController extends AbstractController
{
    #[Route('/', name: 'app_aske')]
    public function index(Request $request): Response
    {
        $aske = new Asked();
        $form = $this->createForm(AskedType::class, $aske);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            dump($aske);
        }
        return $this->render('aske/index.html.twig', [
            'form' => $form
        ]);
    }
}
