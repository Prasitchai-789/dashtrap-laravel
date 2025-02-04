<?php

namespace App\Http\Controllers\HRE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Employee extends Controller
{
    public function employee()
    {
        return view('hre.employee-index');
    }
}
