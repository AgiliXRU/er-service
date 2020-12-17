<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Bed extends Model
{

    use HasFactory;

    protected $fillable = ['id', 'criticalCare', 'patientAssigned'];

    function getAllBeds(): array
    {
        $beds = array();

        $content = Storage::get('beds.csv');

        foreach (preg_split("/\n/",$content) as $line) {
            if ($values = preg_split("/,/", $line)) {
                $bed = new Bed($values);
                array_push($beds, $bed);
            }
        }

        return $beds;
    }
}
