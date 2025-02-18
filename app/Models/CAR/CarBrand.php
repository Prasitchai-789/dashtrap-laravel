<?php

namespace App\Models\CAR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $table = 'car_brands';
    protected $fillable =[
        'car_brand_list',
    ];
}
