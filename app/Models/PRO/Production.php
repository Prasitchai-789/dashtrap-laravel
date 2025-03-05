<?php

namespace App\Models\PRO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    protected $table = 'productions';
    protected $fillable =[
        'Date',
        'FFBPurchase',
        'FFBForward',
        'ShiftA',
        'ShiftB',
        'Shift3',
        'PikupRemain',
        'RamRemain',
        'TotalFFB',
        'AvgPikup',
        'FFBGoodQty',
        'StuckIn',
        'Steam',
        'PikupRemain2',
        'RamRemain2',
        'RawFFB',
        'FFBRemain',
        'CS1',
        'CS2',
    ];
}
