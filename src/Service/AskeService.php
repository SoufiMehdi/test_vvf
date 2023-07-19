<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Asked;
use App\Entity\Applicant;
use App\Repository\AskedRepository;
use App\Repository\ApplicantRepository;

/**
 * @property AskedRepository askedRepo
 * @property ApplicantRepository applicantRepo
 * @property EntityManagerInterface manager
 * @property ContainerBagInterface containerBag
 * @property MailerInterface mailer
*/
class AskeService
{
    public function __construct(
                                    AskedRepository $askedRepo,
                                    ApplicantRepository $applicantRepo,
                                    EntityManagerInterface $manager,
                                    ContainerBagInterface $containerBag,
                                    MailerInterface $mailer
                                )
    {
        $this->askedRepo        = $askedRepo;
        $this->applicantRepo    = $applicantRepo;
        $this->manager          = $manager;
        $this->containerBag     = $containerBag;
        $this->mailer           = $mailer;
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
            $asked->setAskApplicant($applicant);
            $asked->setAskCreatedAt(new \Datetime());
            $result = $this->sendMailAske($asked, $applicant);          
            $this->manager->persist($asked);
            $this->manager->flush();   

        }catch(\Exception $e){
            //dump($e->getMessage());
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
            //dump($e->getMessage());
            return null;
        }
        return $applicant;
    }

    /**
     * Function qui envoie le mail de demande
     * @param Asked $aske
     * @param Applicant $applicant
     * @return bool
    */
    public function sendMailAske(Asked $aske, Applicant $applicant): bool
    {
        try{
            $mailDestination = $this->getEmailDestination();
            $email = new Email();
            $email->from($applicant->getApEmail());
            $email->to($mailDestination);
            $email->subject($aske->getAskSubject());
            $email->text($aske->getAskDescription());
            $this->mailer->send($email);
            $aske->setAskSended(true);
            $aske->setAskSendedAt(new \Datetime());
        }catch(\Exception $e){
            return false;
        }
        return true;
    }

    /**
     * Function qui recupere l'@ de destination
     * @return string
    */
    private function getEmailDestination(): string
    {
        return $this->containerBag->get('demande_email');
    }
}