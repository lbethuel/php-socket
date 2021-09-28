<?php

use Facade\Ignition\Views\Engines\PhpEngine;

$espera = rand(1, 5);
sleep($espera);

// echo "<pre>";
echo "Resposta do servidor que levou $espera segundos" . PHP_EOL;
// echo "</pre>";