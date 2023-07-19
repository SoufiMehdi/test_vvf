<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Asked;
use App\Entity\Applicant;
use App\Repository\AskedRepository;
use App\Repository\ApplicantRepository;

/**
 * @property AskedRepository askedRepo
 * @property ApplicantRepository applicantRepo
 * @property EntityManagerInterface manager
*/
class AskeService
{
    public function __construct(
                                    AskedRepository $askedRepo,
                                    ApplicantRepository $applicantRepo,
                                    EntityManagerInterface $manager
                                )
    {
        $this->askedRepo        = $askedRepo;
        $this->applicantRepo    = $applicantRepo;
        $this->manager          = $manager;
    }

    public function getAllAske(){
        return $this->askedRepo->findAll();
    }

    public function getAllApplicants(){
        return $this->applicantRepo->findAll();
    }
    
    /**
     * Function qui creer est enregistre la demande
     * @param Asked $asked
     * @return bool
    */
    public function createAsked(Asked $asked)
    {
        try{
            $applicant = $this->applicantRepo->findOneBy(['apEmail' => $asked->getAskEmailApplicant()]);
            if(!$applicant){
                $applicant = $this->createApplicant($asked->getAskEmailApplicant());
            }else{
                $nbrAsked = $applicant->getApNomberAske() + 1;
                $applicant->setApNomberAske($nbrAsked);
                $this->manager->persist($applicant);
            }
                
            $asked->setAskCreatedAt(new \Datetime());
            $asked->setAskSended(false);
            $asked->setAskSendedAt(new \Datetime());
            $asked->setAskApplicant($applicant);
            $this->manager->persist($asked);
            $this->manager->flush();   

        }catch(\Exception $e){
            dump($e->getMessage());
            return false;
        }
        return true;
    }

    /**
     * Function qui creer le demandeur avec @ mail
     * @param string $mail
     * @return Asked
     */
    public function createApplicant(string $mail)
    {
        try{
            $applicant = new Applicant();
            $applicant->setApEmail($mail);
            $applicant->setApCreatedAt(new \Datetime());
            $applicant->setApNomberAske(0);
            $this->manager->persist($applicant);
            $this->manager->flush();
        }catch(\Exception $e){
            dump($e->getMessage());
            return null;
        }
        return $applicant;
    }
}