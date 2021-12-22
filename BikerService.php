<?php

declare(strict_types=1);

class BikerService
{
    private $bikersData;

    public function setBikersData(array $bikersData)
    {
        $this->bikersData = $bikersData;
    }

    public function getBikers(): array
    {
        $bikers = [];
        foreach ($this->bikersData as $bikerData) {
            $bikers[] = new Biker(
                (int) $bikerData['count'],
                (float) $bikerData['latitude'],
                (float) $bikerData['longitude']
            );
        }

        return $bikers;
    }

    public function getNearestStationForBikers(array $stations): array
    {
        $nearestStations = [];
        foreach ($this->getBikers() as $biker) {
            $nearestStation = $biker->getNearestStation($stations);

            $nearestStations[$nearestStation->getId()] = [
                'address' => $nearestStation->getAddress(),
                'freeBikeCount' => $nearestStation->getFreeBikeCount(),
                'distance' => $nearestStation->getDistance(),
                'bikerCount' => $biker->getCount(),
            ];
        }

        return $nearestStations;
    }
}
