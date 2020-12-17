<?php


namespace App\Providers;

use App\Models\Bed;
use App\Models\Staff;

class StaffAssignmentProvider
{
    private $shiftStaff;
    private $beds;
    private $bedStaffAssignments;

    /**
     * StaffAssignmentManager constructor.
     */
    public function __construct()
    {
        $staff = new Staff();
        $this->shiftStaff = $staff->getShiftStaff();
        $bedRepo = new Bed();
        $this->beds = $bedRepo->getAllBeds();
        $this->bedStaffAssignments = array();
    }

    public function getShiftStaff(): array
    {
        return $this->shiftStaff;
    }

    public function getBeds(): array
    {
        return $this->beds;
    }

    public function getAvailableStaff(): array
    {
        $availableStaff = array();
        foreach ($this->shiftStaff as $staff) {
            $staffAssigned = false;
            foreach ($this->bedStaffAssignments as $key => $bedListEntry) {
                if (in_array($staff, $bedListEntry)) {
                    $staffAssigned = true;
                }
            }

            if (!$staffAssigned) {
                array_push($availableStaff, $staff);
            }

        }
        return $availableStaff;
    }

    public function getPhysiciansOnDuty(): array
    {
        $physicians = array();
        foreach ($this->shiftStaff as $staff) {

            if ($staff->getAttribute('role') == 'DOCTOR') {
                array_push($physicians, $staff);
            }
        }
        return $physicians;
    }


}
