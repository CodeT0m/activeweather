<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentWeatherController extends AbstractController
{
    /**
     * @Route("/current/weather", name="current_weather")
     */
    public function index(): Response
    {
        $client = new Client([
            'base_uri' => 'api.openweathermap.org/data/2.5/',
        ]);
        $response = $client->request('GET', 'weather?q=Bucharest&appid=400eeadc921bc85d05baffffa5663217&units=metric');
        return $this->json([
            'status' => $response->getStatusCode(),
            'header' => $response->getHeaderLine('content-type'),
            'body'   => json_decode($response->getBody())
        ]);
    }
}
