<?php

namespace DTO;

class VehicleDTO extends BaseDTO
{
    const COLUMNS = [
        'name',
        'maxSpeed',
        'unit',
    ];

    public function __construct(
        public string $name = self::SENTINEL,
        public string|int $maxSpeed = self::SENTINEL,
        public string $unit = self::SENTINEL
    ) {
        /**
         * In every DTO this below line should exist
         * because in parent class it checks for possibility
         * of passing explicit null and differentiates it
         * with not passing a parameter at all
         */
        parent::__construct();
    }
}