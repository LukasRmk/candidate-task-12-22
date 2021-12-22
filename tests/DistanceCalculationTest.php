<?php

use PHPUnit\Framework\TestCase;

require 'Station.php';

final class DistanceCalculationTest extends TestCase
{
    public function testDistanceCalculation(): void
    {
        $station = new Station('testId', 'Test address', 5, 45, 55, 'Test station');

        $this->assertEquals(0, $station->getDistanceToStation(45, 55));

        $this->assertEquals(10, round($station->getDistanceToStation(45.15, 55)));
    }
}
