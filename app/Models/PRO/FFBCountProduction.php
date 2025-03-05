<?php

namespace App\Models\PRO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FFBCountProduction extends Model
{
    use HasFactory;
    protected $table = 'Webapp_FFBProductions';
    protected $fillable =[
        'Date',
        'Shift',
        'StartTime',
        'FinishTime',
        'Quantity',
        'DatePalm1',
        'Contain1',
        'DatePalm2',
        'Contain2',
        'DatePalm3',
        'Contain3',
        'PikupForward',
        'RawFFB',
        'CS1',
        'CS2',
        'FlowMeterBefore',
        'FlowMeterAfter',
        'Amount',
        'Remark',
    ];
}
