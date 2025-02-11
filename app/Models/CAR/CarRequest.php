<?php

namespace App\Models\CAR;

use App\Models\HRE\Employee;
use App\Models\WIN\EMDept;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarRequest extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'car_requests';
    protected $fillable =[
        'user_request',
        'job_request',
        'department_request',
        'status_request',
        'car_request',
        'approver_request',
        'additionalNotes_request',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_request', 'EmpID');
    }

    public function carReport()
    {
        return $this->belongsTo(CarReport::class, 'car_request', 'id');
    }

    public function emDept()
    {
        return $this->belongsTo(EMDept::class, 'department_request', 'DeptID');
    }
}
