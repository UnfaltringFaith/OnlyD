<?php

use App\Http\Controllers\CarAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/cars', [CarAvailability::class, 'index']);