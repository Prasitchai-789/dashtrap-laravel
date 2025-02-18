<?php

namespace App\Models\CAR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $table = 'car_types';
    protected $fillable =[
        'car_type_list',

    ];
}
