<?php

namespace App\Models\WIN;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EMCust extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'EMCust';
    protected $primaryKey = 'CustID'; // ระบุชื่อคอลัมน์ที่เป็น Primary Key ของตาราง
    protected $fillable =[

    ];
}
