<?php

namespace App\Models\CAR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarCharacter extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    protected $table = 'car_characters';
    protected $fillable =[
        'car_character_list',

    ];
}
