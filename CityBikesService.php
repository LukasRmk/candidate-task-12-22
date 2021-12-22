<?php

declare(strict_types=1);

class CityBikesService
{
    private $network;

    public function __construct(string $network)
    {
        $this->network = $network;
    }

    public function getNetworkStations(): array
    {
        $curl = curl_init();
        $url = sprintf('http://api.citybik.es/v2/networks/%s', $this->network);

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $network = json_decode($response, true);

        return $network['network']['stations'];
    }
}
