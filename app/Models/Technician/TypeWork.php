<?php

namespace App\Models\Technician;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeWork extends Model
{
    protected $connection = 'sqlsrv';
    use HasFactory;
    protected $table = 'Webapp_typeworks';
    protected $fillable =[
        'TypeWorkID',
        'TypeWork',
    ];

}
