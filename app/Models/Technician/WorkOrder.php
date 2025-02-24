<?php

namespace App\Models\Technician;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $connection = 'sqlsrv';
    use HasFactory;
    protected $table = 'Webapp_work_orders';
    protected $fillable = [

        'Date',
        'NameOfInformant',
        'Status',
        'TypeWork',
        'Number',
        'MachineName',
        'MachineCode',
        'Detail',
        'Location',
        'WorkStatus',
        'Technician',
        'RepairReport',
        'RepairDate',
        'Remark',
        'Telephone',
        'Image',
        'finishDate',
    ];


    public function typeWork()
    {
        return $this->belongsTo(TypeWork::class, 'TypeWork', 'TypeWorkID');
    }
}
