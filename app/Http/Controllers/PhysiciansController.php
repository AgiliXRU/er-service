<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Patient;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class PhysiciansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Game[]|\Illuminate\Http\Response
     */
    public function index()
    {
        $manager = StaffAssignmentManager::create();
        return $result = $manager->getPhysiciansOnDuty();
    }


}
