<?php


namespace App\Models;


use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    use HasFactory;

    protected $fillable = ['transportId', 'name', 'birthDate', 'priority', 'condition'];

    public function getChildClassification(): int
    {
        return ChildClassification::calculate($this->getAttribute('birthDate'), new DateTime('NOW'));
    }

}
