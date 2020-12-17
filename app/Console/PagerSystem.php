<?php


namespace App\Console;


class PagerSystem
{

    public static function getTransport()
    {
        return new PagerTransport();
    }
}
