<?php

use PHPUnit\Framework\TestCase;

require_once 'CityBikesService.php';

final class StationParsingTest extends TestCase
{
    public function testStationParse(): void
    {
        $cityBikesService = new CityBikesService('bycyklen');

        $stationsRaw = $cityBikesService->getNetworkStations();

        $this->assertNotNull($stationsRaw);
        $this->assertIsArray($stationsRaw);
    }
}
