<?php

namespace App\Entity;

use App\Repository\ApplicantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'askApplicant', targetEntity: Asked::class)]
    private Collection $apAskeds;

    public function __construct()
    {
        $this->apAskeds = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Asked>
     */
    public function getApAskeds(): Collection
    {
        return $this->apAskeds;
    }

    public function addApAsked(Asked $apAsked): static
    {
        if (!$this->apAskeds->contains($apAsked)) {
            $this->apAskeds->add($apAsked);
            $apAsked->setAskApplicant($this);
        }

        return $this;
    }

    public function removeApAsked(Asked $apAsked): static
    {
        if ($this->apAskeds->removeElement($apAsked)) {
            // set the owning side to null (unless already changed)
            if ($apAsked->getAskApplicant() === $this) {
                $apAsked->setAskApplicant(null);
            }
        }

        return $this;
    }
}
