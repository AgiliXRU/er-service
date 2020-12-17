<?php


namespace App\Console;

use RuntimeException;

class PagerTransport
{

    /**
     * PagerTransport constructor.
     */
    public function __construct()
    {
    }

    public function initialize()
    {
        throw new RuntimeException("represents a vendor class requiring install on server");
    }

    public function transmit($targetDevice, $pageText)
    {
        throw new RuntimeException("represents a vendor class requiring install on server");
    }

    public function transmitRequiringAcknowledgement($targetDevice, $pageText)
    {
        throw new RuntimeException("represents a vendor class requiring install on server");
    }

}
