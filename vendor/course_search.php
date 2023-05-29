<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
$client = new Client();

$response  = $client->request('GET', 'https://alura./com.br/cursos-online-programacao/php');
var_dump($response);
$html = $response->getBody();

