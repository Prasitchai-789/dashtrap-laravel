<?php

namespace App\Http\Controllers\MAR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleInvoiceController extends Controller
{
    public function saleInvoice()
    {
        return view('mar.sale-invoice-index');
    }
}
