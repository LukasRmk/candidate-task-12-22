<?php

declare(strict_types=1);

class Biker
{
    private int $count;

    private float $latitude;

    private float $longitude;

    public function __construct(int $count, float $latitude, float $longitude)
    {
        $this->count = $count;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getNearestStation(array $stations): Station
    {
        $nearestStation = null;

        foreach ($stations as $key => $station) {
            $station->setDistance($station->getDistanceToStation($this->longitude, $this->latitude));

            if ($nearestStation === null
                || ($nearestStation->getDistance() >= $station->getDistance()
                && $station->getFreeBikeCount() >= $this->count)
            ) {
                $nearestStation = $station;
            }
        }


        return $nearestStation;
    }
}
