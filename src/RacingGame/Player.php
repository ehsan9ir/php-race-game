<?php

namespace RacingGame;

class Player
{
    private string $name;
    private ?Vehicle $selectedVehicle = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function selectVehicle(Vehicle $vehicle): void
    {
        $this->selectedVehicle = $vehicle;
    }

    public function getSelectedVehicle(): ?Vehicle
    {
        return $this->selectedVehicle;
    }
}
