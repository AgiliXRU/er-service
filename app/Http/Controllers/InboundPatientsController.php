<?php

namespace App\Http\Controllers;

use App\Providers\InboundPatientsProvider;
use App\Providers\EmergencyResponseProvider;

class InboundPatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Game[]|\Illuminate\Http\Response
     */
    public function index()
    {
        $inbound = new InboundPatientsProvider(
            new EmergencyResponseProvider(
                'http://ers.sergeylobin.ru/xml/inbound.xml', 80, 1000));
        return $inbound->currentInboundPatients();
    }

}
