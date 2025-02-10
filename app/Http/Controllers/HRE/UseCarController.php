<?php

namespace App\Http\Controllers\HRE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UseCarController extends Controller
{
    public function useCar()
    {
        return view('hre.use-car-index');
    }
}
