<?php

namespace App\Livewire\PUR;

use App\Models\User;
use Livewire\Component;
use App\Models\MAR\SalesPlan;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ScanBarcodeLive extends Component
{
    public $scannedCode;


    public function updateRecord()
    {
        if (!$this->scannedCode) return;
        $record = SalesPlan::where('barcode', $this->scannedCode)->first();

        if ($record) {
            $record->update(['status' => 'updated']); // แก้ไขข้อมูลตามต้องการ
            session()->flash('message', 'อัปเดตข้อมูลสำเร็จ!');
        } else {
            session()->flash('error', 'ไม่พบรหัสที่สแกน');
        }
    }

    public function onScanSuccess($code)
    {
        $this->scannedCode = $code;
        // คุณสามารถทำการประมวลผลข้อมูลเพิ่มเติมที่นี่
    }
    public function render()
    {
        return view('livewire.pur.scan-barcode-live');
    }
}
