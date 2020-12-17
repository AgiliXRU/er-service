<?php


namespace App\Console;


class PagerSystemAlertTransmitter
{
    public function transmit($targetDevice, $pageText)
    {
        $transport = $this->getTransport();
        $transport->transmit($targetDevice, $pageText);
    }

    public function transmitRequiringAcknowledgement($targetDevice, $pageText)
    {
        $transport = $this->getTransport();
        $transport->transmitRequiringAcknowledgement($targetDevice, $pageText);
    }

    /**
     * @return PagerTransport
     */
    public function getTransport(): PagerTransport
    {
        $transport = PagerSystem::getTransport();
        $transport->initialize();
        return $transport;
    }
}
