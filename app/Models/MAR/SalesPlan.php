<?php

namespace App\Models\MAR;

use App\Models\WIN\EMCust;
use App\Models\WIN\EMGood;
use App\Models\WIN\SOPlanStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPlan extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'SOPlan';
    protected $primaryKey = 'SOPID'; // ระบุชื่อคอลัมน์ที่เป็น Primary Key ของตาราง
    public $timestamps = false; // ปิดการใช้งานคุณสมบัติ timestamps
    protected $fillable =[
        'SOPID',
        'SOPDate',
        'GoodID',
        'GoodName',
        'NumberCar',
        'DriverName',
        'CustID',
        'Recipient',
        'AmntLoad',
        'IBWei',
        'OBWei',
        'NetWei',
        'GoodPrice',
        'GoodAmnt',
        'Status',
        'ReceivedDate',
        'Remarks',
    ];

    public function soPlanStatus()
    {
        return $this->belongsTo(SOPlanStatus::class, 'Status', 'PlanCode');
    }
    public function emCust()
    {
        return $this->belongsTo(EMCust::class, 'CustID', 'CustID');
    }

    public function emGood()
    {
        return $this->belongsTo(EMGood::class, 'GoodID', 'GoodID');
    }
}
