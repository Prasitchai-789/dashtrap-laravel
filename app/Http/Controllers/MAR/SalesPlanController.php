<?php

namespace App\Http\Controllers\MAR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesPlanController extends Controller
{
    public function salesPlan()
    {
        return view('mar.sales-plan-index');
    }
}
