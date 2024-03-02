<?php

namespace RacingGame;

class Vehicle
{
    private string $name;
    private float $maxSpeed;
    private string $speedUnit;

    public function __construct(string $name, float $maxSpeed, string $speedUnit)
    {
        $this->name = $name;
        $this->maxSpeed = $maxSpeed;
        $this->speedUnit = $speedUnit;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMaxSpeed(): float
    {
        return $this->maxSpeed;
    }

    public function getSpeedUnit(): string
    {
        return $this->speedUnit;
    }
}