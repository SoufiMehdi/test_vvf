<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Asked;
use App\Form\AskedType;
use App\Service\AskeService;

class AskeController extends AbstractController
{
    #[Route('/', name: 'app_aske')]
    public function index(Request $request, AskeService $askeService): Response
    {
        $aske = new Asked();
        $form = $this->createForm(AskedType::class, $aske);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $retourCreatedAske = $askeService->createAsked($aske);
            dump($retourCreatedAske);
        }
        $askes = $askeService->getAllAske();
        $applicants = $askeService->getAllApplicants();
        dump($askes, $applicants);
        return $this->render('aske/index.html.twig', [
            'form' => $form
        ]);
    }
}
