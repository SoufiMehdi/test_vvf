<?php

namespace App\Entity;

use App\Repository\ApplicantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ApplicantRepository::class)]
#[UniqueEntity('apEmail')]
class Applicant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Email]
    private ?string $apEmail = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $apCreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $apNomberAske = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApEmail(): ?string
    {
        return $this->apEmail;
    }

    public function setApEmail(string $apEmail): static
    {
        $this->apEmail = $apEmail;

        return $this;
    }

    public function getApCreatedAt(): ?\DateTimeInterface
    {
        return $this->apCreatedAt;
    }

    public function setApCreatedAt(\DateTimeInterface $apCreatedAt): static
    {
        $this->apCreatedAt = $apCreatedAt;

        return $this;
    }

    public function getApNomberAske(): ?int
    {
        return $this->apNomberAske;
    }

    public function setApNomberAske(?int $apNomberAske): static
    {
        $this->apNomberAske = $apNomberAske;

        return $this;
    }
}
