<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantInformationController extends AbstractController
{
    /**
     * @Route("/restaurant/information", name="restaurant_information")
     */
    public function index(): Response
    {
        $client = new Client([
            'base_uri' => 'https://developers.zomato.com/api/v2.1/'
        ]);
        $response = $client->request('GET', 'categories', [
            'headers' => [
                'user-key' => 'ff031df37f2d594dbb2c6a919a67aac3'
            ]
        ]);
        return $this->json([
            'status' => $response->getStatusCode(),
            'header' => $response->getHeaderLine('content-type'),
            'body'   => json_decode($response->getBody())
        ]);
    }
}
