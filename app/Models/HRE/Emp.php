<?php

namespace App\Models\HRE;

use App\Models\Car\UseCar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emp extends Model
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
    // public function usedCars()
    // {
    //     return $this->hasMany(UseCar::class, 'EmpID');
    // }
}
