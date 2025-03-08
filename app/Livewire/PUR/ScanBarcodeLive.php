<?php

namespace App\Livewire\PUR;

use App\Models\MAR\SalesPlan;
use Livewire\Component;

class ScanBarcodeLive extends Component
{
    public $scannedCode;

    public function updateRecord()
    {
        if (!$this->scannedCode) return;
dd($this->scannedCode);
        $record = SalesPlan::where('barcode', $this->scannedCode)->first();

        if ($record) {
            $record->update(['status' => 'updated']); // แก้ไขข้อมูลตามต้องการ
            session()->flash('message', 'อัปเดตข้อมูลสำเร็จ!');
        } else {
            session()->flash('error', 'ไม่พบรหัสที่สแกน');
        }
    }
    public function render()
    {
        return view('livewire.pur.scan-barcode-live');
    }
}
