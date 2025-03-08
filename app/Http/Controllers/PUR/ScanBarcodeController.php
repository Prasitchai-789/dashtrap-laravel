<?php

namespace App\Http\Controllers\PUR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScanBarcodeController extends Controller
{
    public function scanBarcode()
    {
        return view('pur.scan-barcode-index');
    }
}
