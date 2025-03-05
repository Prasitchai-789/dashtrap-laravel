<?php

namespace App\Http\Controllers\PRO;

use App\Http\Controllers\Controller;
use App\Models\PRO\FFBCountProduction;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function Production()
    {
        return view('pro.production-index');
    }

    public function FFBCountProduction()
    {
        return view('pro.FFB-count-production-index');
    }


}
