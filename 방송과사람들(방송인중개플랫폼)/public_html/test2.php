<?php
// 웹소켓 서버 예제
$host = '14.48.175.189'; // 서버 주소
$port = 443; // 서버 포트

$server = stream_socket_server("tcp://$host:$port", $errno, $errstr);

if (!$server) {
    die("Could not create server: $errstr ($errno)");
}

echo "WebSocket 서버가 $host : $port 에서 실행 중입니다.\n";

$clients = [];

while (true) {
    $readSockets = $clients;
    $readSockets[] = $server;

    stream_select($readSockets, $write = null, $except = null, 0, 10);

    if (in_array($server, $readSockets)) {
        $newClient = stream_socket_accept($server);
        $clients[] = $newClient;
        echo "새 클라이언트가 연결되었습니다.\n";
        $handshake = handshake($newClient);
        unset($readSockets[array_search($server, $readSockets)]);
    }

    foreach ($readSockets as $socket) {
        $data = fread($socket, 1024);

        if (!$data) { // 클라이언트가 연결을 끊었을 때
            unset($clients[array_search($socket, $clients)]);
            fclose($socket);
            echo "클라이언트가 연결을 끊었습니다.\n";
            continue;
        }

        $message = unmask($data);
        echo "받은 메시지: $message\n";

        foreach ($clients as $client) {
            fwrite($client, mask($message));
        }
    }
}

function handshake($client)
{
    $request = fread($client, 1024);
    if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $request, $matches)) {
        $key = $matches[1];
        $acceptKey = base64_encode(pack('H*', sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $headers = "HTTP/1.1 101 Switching Protocols\r\n";
        $headers .= "Upgrade: websocket\r\n";
        $headers .= "Connection: Upgrade\r\n";
        $headers .= "Sec-WebSocket-Accept: $acceptKey\r\n\r\n";
        fwrite($client, $headers);
    }
}

function unmask($payload)
{
    $length = ord($payload[1]) & 127;

    if ($length == 126) {
        $masks = substr($payload, 4, 4);
        $data = substr($payload, 8);
    } elseif ($length == 127) {
        $masks = substr($payload, 10, 4);
        $data = substr($payload, 14);
    } else {
        $masks = substr($payload, 2, 4);
        $data = substr($payload, 6);
    }

    $text = '';
    for ($i = 0; $i < strlen($data); ++$i) {
        $text .= $data[$i] ^ $masks[$i % 4];
    }
    return $text;
}

function mask($text)
{
    $b1 = 0x80 | (0x1 & 0x0f);
    $length = strlen($text);

    if ($length <= 125) {
        $header = pack('CC', $b1, $length);
    } elseif ($length > 125 && $length < 65536) {
        $header = pack('CCn', $b1, 126, $length);
    } else {
        $header = pack('CCNN', $b1, 127, $length);
    }
    return $header . $text;
}
?>