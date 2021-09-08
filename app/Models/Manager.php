<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specie;
use App\Models\Animal;

class Manager extends Model
{
    use HasFactory;
    public function managerGetSpecie()
    {
        return $this->belongsTo(Specie::class, 'specie_id', 'id');
    }

    public function managerGetAnimals() {
        return $this->hasMany(Animal::class, 'manager_id', 'id');
    }
}
