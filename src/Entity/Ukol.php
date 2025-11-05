<?php

namespace App\Entity;

use App\Repository\UkolRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UkolRepository::class)]
class Ukol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Prosím vyplňte název úkolu')]
    private ?string $nazev = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $popis = null;

    #[ORM\Column]
    private ?\DateTime $dokdy = null;

    #[ORM\Column]
    private ?bool $dokonceno = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): static
    {
        $this->nazev = $nazev;

        return $this;
    }

    public function getPopis(): ?string
    {
        return $this->popis;
    }

    public function setPopis(?string $popis): static
    {
        $this->popis = $popis;

        return $this;
    }

    public function getDokdy(): ?\DateTime
    {
        return $this->dokdy;
    }

    public function setDokdy(\DateTime $dokdy): static
    {
        $this->dokdy = $dokdy;

        return $this;
    }

    public function isDokonceno(): ?bool
    {
        return $this->dokonceno;
    }

    public function setDokonceno(bool $dokonceno): static
    {
        $this->dokonceno = $dokonceno;

        return $this;
    }
}
