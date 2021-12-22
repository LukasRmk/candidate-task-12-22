<?php

declare(strict_types=1);

class Station
{
    public const EARTH_RADIUS = 6371;

    private string $id;

    private string $address;

    private int $freeBikeCount;

    private float $longitude;

    private float $latitude;

    private string $name;

    private ?float $distance;

    public function __construct(string $id, string $address, int $freeBikeCount, float $longitude, float $latitude, string $name)
    {
        $this->id = $id;
        $this->address = $address;
        $this->freeBikeCount = $freeBikeCount;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getFreeBikeCount(): int
    {
        return $this->freeBikeCount;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDistance(): ?float
    {
        if (isset($this->distance)) {
            return $this->distance;
        }

        return null;
    }

    public function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    public function getDistanceToStation(float $startLongitude, float $startLatitude): float
    {
        $latitudeDelta = deg2rad($startLatitude - $this->latitude);
        $longitudeDelta = deg2rad($startLongitude - $this->longitude);

        $a = sin($latitudeDelta / 2) * sin($latitudeDelta / 2)
            + cos(deg2rad($this->latitude))
            * cos(deg2rad($startLatitude))
            * sin($longitudeDelta / 2)
            * sin($longitudeDelta / 2);

        $c = 2 * asin(sqrt($a));

        return $c * self::EARTH_RADIUS;
    }
}
