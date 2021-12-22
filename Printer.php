<?php

declare(strict_types=1);

class Printer
{
    public function printData(array $nearestStations): void
    {
        foreach ($nearestStations as $nearestStation) {
            if ($nearestStation['bikerCount'] > $nearestStation['freeBikeCount']) {
                printf(
                    "\nNo station with enough bikes was found for %s bikers\n",
                    $nearestStation['bikerCount']
                );
                continue;
            }

            printf(
                "\ndistance: %s\naddress: %s\nfree_bike_count: %s\nnbiker_count: %s\n",
                $nearestStation['distance'],
                $nearestStation['address'],
                $nearestStation['freeBikeCount'],
                $nearestStation['bikerCount']
            );
        }
    }
}
