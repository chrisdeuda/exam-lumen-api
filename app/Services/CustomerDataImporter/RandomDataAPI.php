<?php

namespace App\Services\CustomerDataImporter;

use GuzzleHttp\Client;

class RandomDataAPI{

    /**
     * API URL Fofr getting random data
     *
     * @var string
     */
    private const BASE_URL = "https://randomuser.me";

    /**
     * Settings to pass in the API
     *
     * @array  DEFAULT_QUERY_PARAMETERS
     */
    private const DEFAULT_QUERY_PARAMETERS = [
        'results' => 100,
        'nat' => 'au',
        'inc' => 'name,login,location,email,gender,phone',
    ];


    public static function getData(){

        $client = new Client(['base_uri' => self::BASE_URL]);

        //@TODO add error handler
        $response = $client->request('GET', 'api',
            [
                'query' => self::DEFAULT_QUERY_PARAMETERS
            ]
        );
        if($response->getBody()){

            $items = json_decode((string) $response->getBody(), true);

            if(count($items['results'])){
                return $items['results'];
            }
        }

        return [];

    }

}
