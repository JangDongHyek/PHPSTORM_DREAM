<?php
set_time_limit(0);

class ChatServer {
    private $host;
    private $port;
    private $socket;
    private $clients;
    private $rooms;

    public function __construct($host, $port) {
        $this->host = $host;
        $this->port = $port;
        $this->clients = [];
        $this->rooms = [];
        $this->createSocket();
    }

    private function createSocket() {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($this->socket, $this->host, $this->port);
        socket_listen($this->socket);
    }

    public function run() {
        while (true) {
            $changed = $this->clients;
            $changed[] = $this->socket;
            socket_select($changed, $null, $null, 0, 10);

            if (in_array($this->socket, $changed)) {
                $socket_new = socket_accept($this->socket);
                $this->clients[] = $socket_new;
                $header = socket_read($socket_new, 1024);
                $this->performHandshaking($header, $socket_new);
                socket_getpeername($socket_new, $ip);
                $this->sendMessageToClient($socket_new, json_encode(['type' => 'system', 'message' => 'Connected']));
                $index = array_search($this->socket, $changed);
                unset($changed[$index]);
            }

            foreach ($changed as $changed_socket) {
                while (socket_recv($changed_socket, $buf, 1024, 0) >= 1) {
                    $received_text = $this->unmask($buf);
                    $msg = json_decode($received_text, true);
                    if (isset($msg['room'])) {
                        $room = $msg['room'];
                        if (!isset($this->rooms[$room])) {
                            $this->rooms[$room] = [];
                        }
                        $this->rooms[$room][$changed_socket] = true;
                        $this->sendMessageToRoom($room, json_encode(['type' => 'usermsg', 'message' => $msg['message']]));
                    }
                    break 2;
                }

                $buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
                if ($buf === false) {
                    $this->removeClient($changed_socket);
                }
            }
        }
    }

    private function removeClient($client) {
        $index = array_search($client, $this->clients);
        if ($index !== false) {
            unset($this->clients[$index]);
        }
        foreach ($this->rooms as &$clients) {
            if (isset($clients[$client])) {
                unset($clients[$client]);
            }
        }
        socket_getpeername($client, $ip);
        $this->sendMessageToClient($client, json_encode(['type' => 'system', 'message' => 'Disconnected']));
    }

    private function sendMessageToClient($client, $msg) {
        @socket_write($client, $this->mask($msg), strlen($this->mask($msg)));
    }

    private function sendMessageToRoom($room, $msg) {
        if (isset($this->rooms[$room])) {
            foreach ($this->rooms[$room] as $client => $active) {
                $this->sendMessageToClient($client, $msg);
            }
        }
    }

    private function performHandshaking($header, $client_conn) {
        $headers = [];
        $lines = preg_split("/\r\n/", $header);
        foreach ($lines as $line) {
            if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }
        $secKey = $headers['Sec-WebSocket-Key'];
        $secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "Sec-WebSocket-Accept:$secAccept\r\n\r\n";
        socket_write($client_conn, $upgrade, strlen($upgrade));
    }

    private function mask($text) {
        $b1 = 0x80 | (0x1 & 0x0f);
        $length = strlen($text);
        if ($length <= 125) {
            $header = pack('CC', $b1, $length);
        } elseif ($length >= 126 && $length <= 65535) {
            $header = pack('CCn', $b1, 126, $length);
        } else {
            $header = pack('CCNN', $b1, 127, $length);
        }
        return $header . $text;
    }

    private function unmask($text) {
        $length = ord($text[1]) & 127;
        if ($length == 126) {
            $masks = substr($text, 4, 4);
            $data = substr($text, 8);
        } elseif ($length == 127) {
            $masks = substr($text, 10, 4);
            $data = substr($text, 14);
        } else {
            $masks = substr($text, 2, 4);
            $data = substr($text, 6);
        }
        $text = '';
        for ($i = 0; $i < strlen($data); ++$i) {
            $text .= $data[$i] ^ $masks[$i % 4];
        }
        return $text;
    }
}

$server = new ChatServer('127.0.0.1', 8080);
$server->run();
?>
