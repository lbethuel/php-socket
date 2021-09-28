<?php

$streamList = [
    stream_socket_client('tcp://localhost:8080'),
    fopen('arquivo.txt', 'r'),
    fopen('arquivo2.txt', 'r')
];

fwrite($streamList[0], 'GET /http-server.php HTTP/1.1' . PHP_EOL . PHP_EOL);
foreach ($streamList as $stream) {
    stream_set_blocking($stream, false);
}

do {
    $copyReadStream = $streamList;
    $numeroDeStream = stream_select($copyReadStream, $white, $except, 0, 2000);

    if ($numeroDeStream === 0) {
        continue;
    }

    foreach ($copyReadStream as $key => $stream) {
        $conteudo = stream_get_contents($stream);
        $posicaoFimHttp = strpos($conteudo, "\r\n\r\n");
        if ($posicaoFimHttp !== false) {
            echo substr($conteudo, $posicaoFimHttp + 4);
        } else {
            echo $conteudo;
        }

        unset($streamList[$key]);
    }
} while (!empty($streamList));

echo "Li todas as streams" . PHP_EOL;
