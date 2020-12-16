<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bed implements BedProvider
{

    use HasFactory;

    protected $fillable = ['name'];

    function getAllBeds(): array
    {
        return array(
        );
    }
}
