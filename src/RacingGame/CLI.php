<?php

namespace RacingGame;

use Foundation\DTO\VehicleDTO;
use Foundation\DTO\VehicleDTOReader;
use Foundation\Utilities\UnitConvertor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CLI extends Command
{
    protected static $defaultName = 'start:race';
    const VEHICLES_PATH = '/../../vehicles.json';

    protected function configure(): void
    {
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Welcome to php-cli Game :)</info>');

        /**
         * @var $vehiclesDTO VehicleDTO[]
         */
        $vehiclesDTO = VehicleDTOReader::readFromFile(__DIR__ . self::VEHICLES_PATH);

        $this->displayTheListOfAvailableVehicles($vehiclesDTO);

        // Create players
        $player1 = new Player('Player 1');
        $player2 = new Player('Player 2');

        // Allow players to select a vehicle
        $selectedVehicleIndexPlayer1 = (int)readline("{$player1->getName()}, select a vehicle (enter vehicle index): ");
        $selectedVehicleIndexPlayer2 = (int)readline("{$player2->getName()}, select a vehicle (enter vehicle index): ");

        $this->validateSelectedVehicle(
            $vehiclesDTO, $selectedVehicleIndexPlayer1, $selectedVehicleIndexPlayer2
        );

        // Create Vehicle objects for selected vehicles
        $selectedVehiclePlayer1 = $this->makeVehicleFromDTO($vehiclesDTO[$selectedVehicleIndexPlayer1]);
        $selectedVehiclePlayer2 = $this->makeVehicleFromDTO($vehiclesDTO[$selectedVehicleIndexPlayer2]);

        // Set selected vehicles for players
        $player1->setVehicle($selectedVehiclePlayer1);
        $player2->setVehicle($selectedVehiclePlayer2);

        // Ask for race distance and unit
        $raceDistance = (float)readline("Enter race distance: ");
        $distanceUnit = $this->getDistanceUnit();

        // Convert to kilometers
        $raceDistance = UnitConvertor::convertToKilometers($raceDistance, $distanceUnit);

        // Run the race
        $race = new RacingGame($player1, $player2, $raceDistance);
        $output->writeln("<info>{$race->startRace()}</info>");

        return Command::SUCCESS;
    }

    private function getDistanceUnit(): string
    {
        $units = ['knots', 'kilometers', 'miles'];

        do {
            $unitIndex = (int)readline("Select distance unit (0 for knots, 1 for kilometers, 2 for miles): ");
        } while (!in_array($unitIndex, [0, 1, 2]));

        return $units[$unitIndex];
    }

    /**
     * @param array $vehiclesDTO
     * @return void
     */
    private function displayTheListOfAvailableVehicles(array $vehiclesDTO): void
    {
        echo "Available Vehicles:\n";
        foreach ($vehiclesDTO as $index => $vehicleDTO)
        {
            echo "[$index] $vehicleDTO->name (Max Speed: $vehicleDTO->maxSpeed $vehicleDTO->unit)\n";
        }
    }

    /**
     * @param VehicleDTO[] $vehiclesDTO
     * @param int $selectedVehicleIndexPlayer1
     * @param int $selectedVehicleIndexPlayer2
     * @return void
     */
    private function validateSelectedVehicle(
        array $vehiclesDTO,
        int $selectedVehicleIndexPlayer1,
        int $selectedVehicleIndexPlayer2
    ): void
    {
        if (!isset($vehiclesDTO[$selectedVehicleIndexPlayer1]) || !isset($vehiclesDTO[$selectedVehicleIndexPlayer2]))
        {
            echo "Invalid vehicle index. Exiting.\n";
            exit(1);
        }
    }

    /**
     * @param VehicleDTO $vehiclesDTO
     * @return Vehicle
     */
    private function makeVehicleFromDTO(VehicleDTO $vehiclesDTO): Vehicle
    {
        return new Vehicle(
            $vehiclesDTO->name,
            $vehiclesDTO->maxSpeed,
            $vehiclesDTO->unit
        );
    }
}