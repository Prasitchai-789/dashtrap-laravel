<?php

namespace App\Models\RPO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetPriceScaler extends Model
{
    use HasFactory;
    protected $table = 'set_price_scalers';
    protected $fillable =[
        'set_price',
        'set_scaler',
    ];
}
