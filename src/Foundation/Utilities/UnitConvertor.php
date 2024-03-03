<?php

namespace Foundation\Utilities;

class UnitConvertor
{
    /**
     * @param float $speed
     * @param string $unit
     * @return float
     */
    public static function convertSpeedToKilometersPerHour(float $speed, string $unit): float
    {
        return match ($unit)
        {
            'Km/h', 'kilometers' => $speed,
            'miles' => $speed * 1.60934,
            'knots', 'Kts' => $speed * 1.852,
            default => throw new \InvalidArgumentException("Unsupported unit: $unit"),
        };
    }

    /**
     * @param float $distance
     * @param string $unit
     * @return float
     */
    public static function convertToKilometers(float $distance, string $unit): float
    {
        return match ($unit)
        {
            'kilometers' => $distance,
            'miles' => $distance * 1.60934,
            'knots', 'Kts' => $distance * 1.852,
            default => throw new \InvalidArgumentException("Unsupported unit: $unit"),
        };
    }
}