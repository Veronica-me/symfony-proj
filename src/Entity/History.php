<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $firstIn = null;

    #[ORM\Column(nullable: true)]
    private ?int $secondIn = null;

    #[ORM\Column(nullable: true)]
    private ?int $firstOut = null;

    #[ORM\Column(nullable: true)]
    private ?int $secondOut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updateDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstIn(): ?int
    {
        return $this->firstIn;
    }

    public function setFirstIn(?int $firstIn): static
    {
        $this->firstIn = $firstIn;

        return $this;
    }

    public function getSecondIn(): ?int
    {
        return $this->secondIn;
    }

    public function setSecondIn(?int $secondIn): static
    {
        $this->secondIn = $secondIn;

        return $this;
    }

    public function getFirstOut(): ?int
    {
        return $this->firstOut;
    }

    public function setFirstOut(?int $firstOut): static
    {
        $this->firstOut = $firstOut;

        return $this;
    }

    public function getSecondOut(): ?int
    {
        return $this->secondOut;
    }

    public function setSecondOut(?int $secondOut): static
    {
        $this->secondOut = $secondOut;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(?\DateTimeInterface $createDate): static
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): static
    {
        $this->updateDate = $updateDate;

        return $this;
    }
}
