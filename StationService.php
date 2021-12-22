<?php

declare(strict_types=1);

class StationService
{
    public function getStations($cityStationData): array
    {
        $stations = [];
        foreach ($cityStationData as $stationData) {
            $station = new Station(
                (string) $stationData['id'],
                (string) $stationData['extra']['address'],
                (int) $stationData['free_bikes'],
                (float) $stationData['longitude'],
                (float) $stationData['latitude'],
                (string) $stationData['name']
            );

            $stations[] = $station;
        }

        return $stations;
    }
}
