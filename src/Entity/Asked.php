<?php

namespace App\Entity;

use App\Repository\AskedRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AskedRepository::class)]
class Asked
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $askSubject = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $askDescription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $askCreatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $askSended = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $askSendedAt = null;

    #[ORM\ManyToOne(inversedBy: 'apAskeds')]
    private ?Applicant $askApplicant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAskSubject(): ?string
    {
        return $this->askSubject;
    }

    public function setAskSubject(string $askSubject): static
    {
        $this->askSubject = $askSubject;

        return $this;
    }

    public function getAskDescription(): ?string
    {
        return $this->askDescription;
    }

    public function setAskDescription(string $askDescription): static
    {
        $this->askDescription = $askDescription;

        return $this;
    }

    public function getAskCreatedAt(): ?\DateTimeInterface
    {
        return $this->askCreatedAt;
    }

    public function setAskCreatedAt(\DateTimeInterface $askCreatedAt): static
    {
        $this->askCreatedAt = $askCreatedAt;

        return $this;
    }

    public function isAskSended(): ?bool
    {
        return $this->askSended;
    }

    public function setAskSended(?bool $askSended): static
    {
        $this->askSended = $askSended;

        return $this;
    }

    public function getAskSendedAt(): ?\DateTimeInterface
    {
        return $this->askSendedAt;
    }

    public function setAskSendedAt(\DateTimeInterface $askSendedAt): static
    {
        $this->askSendedAt = $askSendedAt;

        return $this;
    }

    public function getAskApplicant(): ?Applicant
    {
        return $this->askApplicant;
    }

    public function setAskApplicant(?Applicant $askApplicant): static
    {
        $this->askApplicant = $askApplicant;

        return $this;
    }
}
