<?php

namespace App\Http\Controllers\RPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AveragePriceController extends Controller
{
    public function averagePrice()
    {
        return view('rpo.average-price-index');
    }
}
