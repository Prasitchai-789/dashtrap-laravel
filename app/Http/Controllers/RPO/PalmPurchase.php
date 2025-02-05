<?php

namespace App\Http\Controllers\RPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PalmPurchase extends Controller
{
    public function palmPurchase()
    {
        return view('rpo.palm-purchase-index');
    }
    public function palmPlan()
    {
        return view('rpo.palm-plan-index');
    }
}
