<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manager;
use App\Models\Animal;

class Specie extends Model
{
    use HasFactory;

    public function specieGetManagers() {
        return $this->hasMany(Manager::class, 'specie_id', 'id');
    }
}