<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manager;
use App\Models\Specie;

class Animal extends Model
{
    use HasFactory;

    public function animalGetManager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }
    public function animalGetSpecie()
    {
        return $this->belongsTo(Specie::class, 'specie_id', 'id');
    }
}
