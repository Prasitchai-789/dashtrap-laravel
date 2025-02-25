<?php

namespace App\Http\Controllers\RPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraphPriceController extends Controller
{
    public function graphPrice()
    {
        return view('rpo.graph-price-index');
    }
}
