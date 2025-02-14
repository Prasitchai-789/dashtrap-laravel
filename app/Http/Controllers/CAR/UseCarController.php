<?php

namespace App\Http\Controllers\CAR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UseCarController extends Controller
{
    public function useCar()
    {
        return view('car.use-car-index');
    }
}
