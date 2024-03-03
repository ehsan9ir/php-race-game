<?php

use PHPUnit\Framework\TestCase;
use RacingGame\Player;
use RacingGame\RacingGame;
use RacingGame\Vehicle;

class CalculateDuringTimeBasedMaximumSpeedTimeTest extends TestCase
{
    public function testVehicleTimeWithKMPerHourMaxSpeed()
    {
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');

        $vehicle1 = new Vehicle('Car', 200, 'Km/h');

        $player1->setVehicle($vehicle1);

        // Create RacingGame instance
        $raceDistance = 250;
        $race = new RacingGame($player1, $player2, $raceDistance);

        $duringTimeWithHour = $race->calculateTime($player1);

        $this->assertEquals(1.25, $duringTimeWithHour);
    }

    public function testVehicleTimeWithKtsPerHourMaxSpeed()
    {
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');

        $vehicle1 = new Vehicle('Helicopter', 140, 'Kts');

        $player1->setVehicle($vehicle1);

        // Create RacingGame instance
        $raceDistance = 456; //this unit is km
        $race = new RacingGame($player1, $player2, $raceDistance);

        $duringTimeWithHour = $race->calculateTime($player1);

        $this->assertGreaterThanOrEqual(1.75, $duringTimeWithHour);
    }

    public function testVehicleTimeWithKnotsPerHourMaxSpeed()
    {
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');

        $vehicle1 = new Vehicle('Jet Ski', 50, 'knots');

        $player1->setVehicle($vehicle1);

        // Create RacingGame instance
        $raceDistance = 90; //this unit is km
        $race = new RacingGame($player1, $player2, $raceDistance);

        $duringTimeWithHour = $race->calculateTime($player1);

        $this->assertGreaterThanOrEqual(0.97, $duringTimeWithHour);
    }
}
