<?php

namespace App\Http\Controllers\RPO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportRPOController extends Controller
{
    public function reportPOInv()
    {
        return view('rpo.report-POInv-index');
    }
}
