<?php

namespace App\Models\WIN;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POInvDTCar extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'POInvDTCars';
    protected $fillable =[
        'TypeCarID',
        'TypeCarName',
    ];
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}

