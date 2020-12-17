<?php

namespace App\Providers;


use Illuminate\Support\Facades\Http;

class EmergencyResponseProvider
{
    /**
     * @var string
     */
    private $url;

    /**
     * EmergencyResponseProvider constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    function fetchInboundPatients(): string
    {
        return Http::get($this->url)->body();
    }

}
