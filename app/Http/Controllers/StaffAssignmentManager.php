<?php


namespace App\Http\Controllers;


use App\Models\Bed;
use App\Models\BedProvider;
use App\Models\Staff;
use App\Models\StaffProvider;

class StaffAssignmentManager
{
    private $shiftStaff;
    private $beds;
    private $bedStaffAssignments;

    /**
     * StaffAssignmentManager constructor.
     * @param StaffProvider $staff
     * @param BedProvider $bedRepo
     */
    public function __construct(StaffProvider $staff, BedProvider $bedRepo)
    {
        $this->shiftStaff = $staff->getShiftStaff();
        $this->beds = $bedRepo->getAllBeds();
        $this->bedStaffAssignments = array();
    }

    public static function create(): StaffAssignmentManager
    {
        return new StaffAssignmentManager(new Staff(), new Bed());
    }

    public function getShiftStaff(): array
    {
        return $this->shiftStaff;
    }

    public function getBeds() : array
    {
        return $this->beds;
    }

    public function getAvailableStaff(): array
    {
        $availableStaff = array();
        foreach ($this->shiftStaff as $staff) {
            $staffAssigned = false;
            foreach ($this->bedStaffAssignments as $key => $bedListEntry) {
                if ( in_array($staff, $bedListEntry)) {
                    $staffAssigned = true;
                }
            }

            if (!$staffAssigned) {
                array_push($availableStaff, $staff);
            }

            return $availableStaff;
        }
    }

    public function getPhysiciansOnDuty(): array
    {
        $physicians = array();
        foreach ( $this->shiftStaff as $staff ) {

            if ($staff->getAttribute('role') == 'DOCTOR' || $staff->getAttribute('role') == 'RESIDENT') {
                array_push($physicians, $staff);
            }
        }
        return $physicians;
    }


}
