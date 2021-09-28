<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

require_once 'vendor/autoload.php';

$client = new Client();

$promessa1 = $client->getAsync('http://localhost:8080/http-server.php');
$promessa2 = $client->getAsync('http://localhost:8000/http-server.php');

$resposta = Utils::unwrap([
    $promessa1, $promessa2
]);

echo 'Resposta 1: ' . $resposta[0]->getBody()->getContents();
echo 'Resposta 2: ' . $resposta[1]->getBody()->getContents();