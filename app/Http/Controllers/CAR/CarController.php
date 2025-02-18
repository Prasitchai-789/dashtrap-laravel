<?php

namespace App\Http\Controllers\CAR;

use Illuminate\Http\Request;
use App\Models\CAR\CarReport;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function carRequest()
    {
        return view('car.car-request-index');
    }

    public function carReport()
    {
        return view('car.car-report-index');
    }

    public function carView($carReportId)
    {
        session(['carReportId' => $carReportId]);
        return view('car.car-view-index');
    }
}
