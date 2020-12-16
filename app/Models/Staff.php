<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model implements StaffProvider
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'role'];

    function getShiftStaff() {
        return $this->all();
    }

}
