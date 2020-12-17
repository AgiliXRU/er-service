<?php

namespace App\Http\Controllers;



use App\Providers\StaffAssignmentProvider;

class PhysiciansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Game[]|\Illuminate\Http\Response
     */
    public function index()
    {
        $staffProvider = new StaffAssignmentProvider();
        return $result = $staffProvider->getPhysiciansOnDuty();
    }


}
