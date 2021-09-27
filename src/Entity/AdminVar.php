<?php

namespace App\Entity;

use App\Repository\AdminVarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminVarRepository::class)
 */
class AdminVar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $MoneyInCirculation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $availableRoyalties;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalRoyalties;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updateDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoneyInCirculation(): ?float
    {
        return $this->MoneyInCirculation;
    }

    public function setMoneyInCirculation(?float $MoneyInCirculation): self
    {
        $this->MoneyInCirculation = $MoneyInCirculation;

        return $this;
    }

    public function getAvailableRoyalties(): ?float
    {
        return $this->availableRoyalties;
    }

    public function setAvailableRoyalties(?float $availableRoyalties): self
    {
        $this->availableRoyalties = $availableRoyalties;

        return $this;
    }

    public function getTotalRoyalties(): ?float
    {
        return $this->totalRoyalties;
    }

    public function setTotalRoyalties(?float $totalRoyalties): self
    {
        $this->totalRoyalties = $totalRoyalties;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }
}
