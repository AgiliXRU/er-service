<?php

namespace App\Providers;


use Illuminate\Support\Facades\Http;

class EmergencyResponseProvider
{
    private $url;
    private $port;
    private $timeout;
    private $socket;

    /**
     * EmergencyResponseProvider constructor.
     * @param string $url
     * @param int $port
     * @param int $timeout
     */
    public function __construct(string $url, int $port, int $timeout)
    {
        $this->url = $url;
        $this->port = $port;
        $this->timeout = $timeout;
        $this->socket = $this->connect();
    }

    function connect() {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_connect($socket, '104.248.47.45', $this->port);
        return $socket;
    }

    function fetchInboundPatients(): string
    {
        return Http::get($this->url)->body();
    }

}
