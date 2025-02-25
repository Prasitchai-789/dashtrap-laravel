<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableTotalPalmController extends Controller
{
    public function tableTotalPalm()
    {
        return view('dashboard.table-total-palm-index');
    }
}
