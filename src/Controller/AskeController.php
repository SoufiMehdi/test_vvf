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
        $error = false;
        $aske = new Asked();
        $form = $this->createForm(AskedType::class, $aske);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $retourCreatedAske = $askeService->createAsked($aske);
            if($retourCreatedAske)
                return $this->redirectToRoute('succes_aske_create');
            else
                $error = true;    
        }
        $askes = $askeService->getAllAske();
        $applicants = $askeService->getAllApplicants();
        dump($askes, $applicants);
        return $this->render('aske/index.html.twig', [
            'form' => $form,
            'error' => $error
        ]);
    }

    #[Route('/succes-aske-create', name:"succes_aske_create")]
    public function succesAskeCreate(): Response
    {
        return $this->render('aske/success_aske_create.html.twig');
    }
}
