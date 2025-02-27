<?php

namespace App\Models\WIN;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICDocuTypeDT extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'ICDocuTypeDT';
    protected $primaryKey = 'DocuType';
    protected $fillable =[

    ];
}
