<?php

namespace App\Models\WIN;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EMGoodUnit extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'EMGoodUnit';
    protected $fillable =[

    ];
}
