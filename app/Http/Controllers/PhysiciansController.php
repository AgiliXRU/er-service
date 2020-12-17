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
        $manager = new StaffAssignmentProvider();
        return $result = $manager->getPhysiciansOnDuty();
    }


}
