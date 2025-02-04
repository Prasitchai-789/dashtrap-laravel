<?php

namespace App\Models\WIN;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebappPOInv extends Model
{
    protected $connection = 'sqlsrv2';
    use HasFactory;
    protected $table = 'Webapp_POInv';
    protected $fillable = [
        'POInvID',
        'DocuDate',
        'BillID',
        'VendorCarID',
        'TypeCarID',
        'GoodIB',
        'GoodOB',
        'GoodNet',
        'Price1',
        'Amnt1',
        'Price2',
        'Amnt2',
        'VendorCode',
        'StatusBill',
        'Grade',
        'Impurity',
        'Scaler',
        'DocuType',
    ];

    protected $primaryKey = 'POInvID';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    public function empVendor()
    {
        return $this->belongsTo(EMVendor::class, 'VendorCode', 'VendorCode');
    }
    public function poInvDTCar()
    {
        return $this->belongsTo(POInvDTCar::class, 'TypeCarID', 'TypeCarID');
    }
}
