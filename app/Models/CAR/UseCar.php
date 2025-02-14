<?php

namespace App\Models\CAR;

use App\Models\HRE\Employee;
use App\Models\CAR\CarReport;
use App\Models\WIN\EMDept;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UseCar extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'car_uses';
    protected $fillable =[
        'card_id',
        'car_id',
        'user_request',
        'use_job',
        'use_start',
        'use_end',
        'use_distance',
        'use_status',
        'additionalNotes',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_request', 'EmpID');
    }

    public function carReport()
    {
        return $this->belongsTo(CarReport::class, 'car_id', 'id');
    }

    public function emDept()
    {
        return $this->belongsTo(EMDept::class, 'department_request', 'DeptID');
    }
}
