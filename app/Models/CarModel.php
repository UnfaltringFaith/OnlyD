<?php

namespace App\Models;

use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function comfortCategory()
    {
        return $this->belongsTo(ComfortCategory::class, 'comfort_category_id');
    }
}
