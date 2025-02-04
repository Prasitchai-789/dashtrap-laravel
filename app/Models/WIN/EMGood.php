<?php

namespace App\Models\WIN;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EMGood extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'EMGood';
    protected $fillable =[

    ];
}
