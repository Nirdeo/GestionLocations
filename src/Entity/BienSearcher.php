<?php

namespace App\Entity;

class BienSearcher
{
    // attribut permettant de trouver les propriétés d'un objet
    // un permettant de trier les résidences par villes
    // un autre autre permettant de voir les résidences actuellement louées ou non
    // cette classe est liée à la classe Bien

    private $city;

    private $isRented;

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getIsRented(): ?bool
    {
        return $this->isRented;
    }

    public function setIsRented(bool $isRented): self
    {
        $this->isRented = $isRented;

        return $this;
    }
}
