<?php

namespace App\Http\Controllers\RPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesProductController extends Controller
{
    public function salesProduct()
    {
        return view('rpo.sales-product-index');
    }
}
