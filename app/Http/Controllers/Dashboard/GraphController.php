<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function graphPalmPuchase()
    {
        return view('dashboard.graph-index');
    }
}
