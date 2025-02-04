<?php

namespace App\Models\WIN;

use App\Models\WIN\EMDept;
use App\Models\WIN\ICStockDT;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ICStockHD extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'ICStockHD';
    protected $fillable =[

    ];

    public function StockDT()
    {
        return $this->belongsTo(ICStockDT::class, 'DocuID', 'DocuID');
    }
    public function EMDept()
    {
        return $this->belongsTo(EMDept::class, 'DeptID', 'DeptID');
    }
}
