<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraphTotalPalmController extends Controller
{
    public function graphTotalPalm()
    {
        return view('dashboard.graph-total-palm-index');
    }
}
