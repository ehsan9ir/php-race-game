<?php

namespace RacingGame;

use Foundation\Utilities\UnitConvertor;

class RacingGame
{
    private Player $player1;
    private Player $player2;
    public float $distance;

    public Player $winner;

    public function __construct(Player $player1, Player $player2, float $distance)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->distance = $distance;
    }

    public function calculateTime(Player $player): float
    {
        $selectedVehicle = $player->getSelectedVehicle();

        // Check if a vehicle is not selected
        if ($selectedVehicle === null) {
            echo "{$player->getName()} has not selected a vehicle. Exiting.\n";
            exit(1);
        }

        // Convert the maximum speed to kilometers per hour
        $maxSpeedInKmPerHour = UnitConvertor::convertSpeedToKilometersPerHour(
            $selectedVehicle->getMaxSpeed(),
            $selectedVehicle->getSpeedUnit()
        );

        // Calculate time(hour) based on converted maximum speed
        return $this->distance / $maxSpeedInKmPerHour;
    }
}
