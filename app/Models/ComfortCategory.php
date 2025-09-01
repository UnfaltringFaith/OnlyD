<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComfortCategory extends Model
{
    //
    public function models()
    {
        return $this->hasMany(CarModel::class);
    }

    public function positions()
    {
        return $this->hasManyThrough(Position::class, CarModel::class);
    }
}
