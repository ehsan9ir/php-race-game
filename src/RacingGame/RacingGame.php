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

    public function startRace(): string
    {
        $this->printHeader();

        $timePlayer1 = $this->calculateTime($this->player1);
        $timePlayer2 = $this->calculateTime($this->player2);

        $this->printRaceResult($timePlayer1, $timePlayer2);

        $this->winner = $this->determineWinner($timePlayer1, $timePlayer2);

        return $this->getWinnerText($this->winner);
    }

    private function determineWinner(float $timePlayer1, float $timePlayer2): Player
    {
        return $timePlayer1 < $timePlayer2 ? $this->player1 : $this->player2;
    }

    private function printHeader(): void
    {
        echo "\n🚩🚩 **************************** 🚩🚩\n";
        echo "Race started!\n";
    }

    private function printRaceResult(float $timePlayer1, float $timePlayer2): void
    {
        echo "\n🏁🏁 Race Results: 🏁🏁\n";
        echo "{$this->player1->getName()}'s time: $timePlayer1 hours\n";
        echo "{$this->player2->getName()}'s time: $timePlayer2 hours\n";
        echo "\nRace distance: $this->distance kilometers\n";
    }

    private function getWinnerText(Player $winner): string
    {
        return "\n🏆 {$winner->getName()} ({$winner->getSelectedVehicle()->getName()}) wins the race!\n";
    }
}
