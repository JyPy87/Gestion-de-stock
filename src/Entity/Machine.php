<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 */
class Machine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Consumable::class, mappedBy="machine")
     */
    private $consumables;

    /**
     * @ORM\OneToMany(targetEntity=Supply::class, mappedBy="machine")
     */
    private $supplies;

    public function __construct()
    {
        $this->consumables = new ArrayCollection();
        $this->supplies = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Consumable[]
     */
    public function getConsumables(): Collection
    {
        return $this->consumables;
    }

    public function addConsumable(Consumable $consumable): self
    {
        if (!$this->consumables->contains($consumable)) {
            $this->consumables[] = $consumable;
            $consumable->setMachine($this);
        }

        return $this;
    }

    public function removeConsumable(Consumable $consumable): self
    {
        if ($this->consumables->removeElement($consumable)) {
            // set the owning side to null (unless already changed)
            if ($consumable->getMachine() === $this) {
                $consumable->setMachine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Supply[]
     */
    public function getSupplies(): Collection
    {
        return $this->supplies;
    }

    public function addSupply(Supply $supply): self
    {
        if (!$this->supplies->contains($supply)) {
            $this->supplies[] = $supply;
            $supply->setMachine($this);
        }

        return $this;
    }

    public function removeSupply(Supply $supply): self
    {
        if ($this->supplies->removeElement($supply)) {
            // set the owning side to null (unless already changed)
            if ($supply->getMachine() === $this) {
                $supply->setMachine(null);
            }
        }

        return $this;
    }
}
