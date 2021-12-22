<?php

declare(strict_types=1);

require_once 'FileReader.php';
require_once 'CityBikesService.php';
require_once 'StationService.php';
require_once 'BikerService.php';
require_once 'Printer.php';
require 'Station.php';
require 'Biker.php';

const NETWORK = 'bycyklen';
const FILE_NAME = 'bikers.csv';

$fileReader = new FileReader(FILE_NAME);
$stationService = new StationService();
$bikerService = new BikerService();
$cityBikesService = new CityBikesService(NETWORK);
$printer = new Printer();

$stations = $stationService->getStations($cityBikesService->getNetworkStations());
$bikerService->setBikersData($fileReader->getFileReader()->getFileData($fileReader->getFile()));
$printer->printData($bikerService->getNearestStationForBikers($stations));
