<?php

namespace App\Models\RPO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AveragePrice extends Model
{
    use HasFactory;
    protected $table = 'average_prices';
    protected $fillable =[
        'created_at',
        'price_font',
        'price_isp',
        'price_ssg_sakon',
        'price_app',
        'price_ssg_chon',
        'price_sang',
        'price_see',
        'price_wijit',
        'price_uni',
        'price_chaw',
        'remark',
    ];

    public $timestamps = false;
}
