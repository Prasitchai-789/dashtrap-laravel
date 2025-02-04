<?php

namespace App\Models\HRE;

use App\Models\WIN\EmpTitle;
use App\Models\WIN\Religion;
use App\Models\WIN\Education;
use App\Models\WIN\WebappDept;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'Webapp_Emp';
    protected $primaryKey = 'EmpID'; // ระบุชื่อคอลัมน์ที่เป็น Primary Key ของตาราง
    public $timestamps = false; // ปิดการใช้งานคุณสมบัติ timestamps
    protected $fillable =[
        'EmpID',
        'IDCardNumber',
        'EmpCode',
        'EmpTitle',
        'EmpName',
        'Position',
        'DeptID',
        'BeginWorkDate',
        'BirthDay',
        'EduID',
        'ReligionID',
        'Address',
        'SubDistID',
        'DistID',
        'ProvinceID',
        'ZipCode',
        'Image',
        'Status',
        'Email',
        'Tel',
        'Company',
    ];

    public function education()
    {
        return $this->belongsTo(Education::class, 'EduID', 'EduID');
    }
    public function religion()
    {
        return $this->belongsTo(Religion::class, 'ReligionID', 'ReligionID');
    }
    public function empTitle()
    {
        return $this->belongsTo(EmpTitle::class, 'EmpTitle', 'EmpTitleID');
    }
    public function webDept()
    {
        return $this->belongsTo(WebappDept::class, 'DeptID', 'DeptID');
    }
}
