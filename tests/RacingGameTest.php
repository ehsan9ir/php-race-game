<?php

use PHPUnit\Framework\TestCase;
use RacingGame\Player;
use RacingGame\RacingGame;
use RacingGame\Vehicle;

class RacingGameTest extends TestCase
{
    public function testVehicleUnitIsKMAndAssertWinnerTextAndTime()
    {
        // Create players
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');

        // Create vehicles
        $vehicle1 = new Vehicle('Car', 200, 'Km/h');
        $vehicle2 = new Vehicle('Bus', 100, 'Km/h');

        // Select vehicles for players
        $player1->selectVehicle($vehicle1);
        $player2->selectVehicle($vehicle2);

        // Create RacingGame instance
        $raceDistance = 100;
        $race = new RacingGame($player1, $player2, $raceDistance);

        // Run the startRace method
        $resultText = $race->startRace();

        $this->assertStringContainsString('Player 1', $resultText);
        $this->assertEquals('Car', $race->winner->getSelectedVehicle()->getName());
        $this->assertEquals(0.5, $race->calculateTime($player1));
        $this->assertEquals(1, $race->calculateTime($player2));
    }
}
