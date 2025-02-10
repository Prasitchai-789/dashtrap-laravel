<?php

namespace App\Http\Controllers\ACC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchasePriceController extends Controller
{
    public function purchasePrice()
    {
        return view('acc.purchase-price-index');
    }
}
