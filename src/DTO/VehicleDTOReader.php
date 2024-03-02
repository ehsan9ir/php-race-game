<?php

namespace DTO;

class VehicleDTOReader
{
    /**
     * Read vehicles data from JSON file and return an array of VehicleDTO objects
     *
     * @param string $filePath
     * @return array
     */
    public static function readFromFile(string $filePath): array
    {
        $jsonContent = file_get_contents($filePath);
        $vehiclesData = json_decode($jsonContent, true);

        $vehicleDTOs = [];

        foreach ($vehiclesData as $vehicleData) {
            $vehicleDTO = self::createVehicleDTO($vehicleData);
            $vehicleDTOs[] = $vehicleDTO;
        }

        return $vehicleDTOs;
    }

    /**
     * Create a VehicleDTO object from data
     *
     * @param array $data
     * @return VehicleDTO
     */
    private static function createVehicleDTO(array $data): VehicleDTO
    {
        $dto =  new VehicleDTO();

        foreach ($data as $key => $value) {
            $dto->{$key} = $value;
        }

        return $dto;
    }
}