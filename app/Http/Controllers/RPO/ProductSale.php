<?php

namespace App\Http\Controllers\RPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductSale extends Controller
{
    public function productSale()
    {
        return view('rpo.product-sale-index');
    }
}
