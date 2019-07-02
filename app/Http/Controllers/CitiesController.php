<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class CitiesController extends Controller
{
    public function index()
    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://www.datos.gov.co/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', 'resource/xdk5-pm3f.json');


        $collection =  collect(json_decode($response->getBody()->getContents()));
        return $collection;
    }
}
