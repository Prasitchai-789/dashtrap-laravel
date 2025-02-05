<?php

namespace App\Models\RPO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PalmPlan extends Model
{
    use HasFactory;
    protected $table = 'palm_plans';
    protected $fillable =[
        'list_plan',
        'palm_plan',
        'actual_plan',
        'per_plan',
    ];
}
