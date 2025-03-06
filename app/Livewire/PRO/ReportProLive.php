<?php

namespace App\Livewire\PRO;

use App\Models\PRO\FFBCountProduction;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\PRO\Production;

class ReportProLive extends Component
{
    public $Date;
    public $FFBPurchase;
    public $FFBForward;
    public $ShiftA;
    public $ShiftB;
    public $Shift3;
    public $PikupRemain;
    public $RamRemain;
    public $TotalFFB;
    public $AvgPikup;
    public $FFBGoodQty;
    public $StuckIn;
    public $Steam;
    public $PikupRemain2;
    public $RamRemain2;
    public $RawFFB;
    public $FFBRemain;
    public $CS1;
    public $CS2;
    public $tonCS1;
    public $tonCS2;
    public $sumPikUpRemain;
    public $sumShiftPikUp;
    public $tonShiftA;
    public $tonShiftB;
    public $tonShift3;
    public $selectedDate;
    public function sumPikUpRemain()
    {
        $stuckIn = is_numeric($this->StuckIn) ? $this->StuckIn : 0;
        $steam = is_numeric($this->Steam) ? $this->Steam : 0;
        $ffbForward = is_numeric($this->FFBForward) ? $this->FFBForward : 0;

        if ($this->FFBGoodQty > 0) {
            $sumPikUpRemain = ($stuckIn + $steam) * $this->avgPikUp();
        } else {
            $sumPikUpRemain = $ffbForward;
        }

        return $sumPikUpRemain;
    }
    public function sumFFBRemain()
    {
        $this->FFBRemain = number_format($this->sumFFB() - $this->sumFFBGoodQty(), 2, '.', ',');
        return $this->FFBRemain;
    }
    public function sumFFB()
    {
        $ffbPurchase = is_numeric($this->FFBPurchase) ? (float) str_replace(',', '', $this->FFBPurchase) : 0;
        $ffbForward = is_numeric($this->FFBForward) ? (float) str_replace(',', '', $this->FFBForward) : 0;

        return $ffbPurchase + $ffbForward;
    }
    public function sumFFBGoodQty()
    {
        $shiftA = is_numeric($this->ShiftA) ? $this->ShiftA : 0;
        $shiftB = is_numeric($this->ShiftB) ? $this->ShiftB : 0;
        $shift3 = is_numeric($this->Shift3) ? $this->Shift3 : 0;
        $avgPickup = is_numeric($this->avgPikUp()) ? $this->avgPikUp() : 0;

        $this->FFBGoodQty = number_format(($shiftA + $shiftB + $shift3) * $avgPickup, 2, '.', ',');
        $FFBGoodQty = (float) ($shiftA + $shiftB + $shift3) * $avgPickup;

        return $FFBGoodQty;
    }
    public function avgPikUp()
    {
        $sumFFB = is_numeric($this->sumFFB()) ? $this->sumFFB() : 0;
        $sumShift = is_numeric($this->sumShift()) && $this->sumShift() > 0 ? $this->sumShift() : 1;

        $this->AvgPikup = number_format($sumFFB / $sumShift, 2);

        $AvgPikup = $sumFFB / $sumShift;
        return $AvgPikup;
    }
    public function sumShift()
    {
        $shiftA = is_numeric($this->ShiftA) ? $this->ShiftA : 0;
        $shiftB = is_numeric($this->ShiftB) ? $this->ShiftB : 0;
        $shift3 = is_numeric($this->Shift3) ? $this->Shift3 : 0;
        $pikupRemain = is_numeric($this->PikupRemain) ? $this->PikupRemain : 0;
        $ramRemain = is_numeric($this->RamRemain) ? $this->RamRemain : 0;

        $sumPikUp = $shiftA + $shiftB + $shift3 + $pikupRemain + $ramRemain;

        return $sumPikUp;
    }
    public function sumShiftPikUp()
    {
        $shiftA = is_numeric($this->ShiftA) ? $this->ShiftA : 0;
        $shiftB = is_numeric($this->ShiftB) ? $this->ShiftB : 0;
        $shift3 = is_numeric($this->Shift3) ? $this->Shift3 : 0;

        $sumShiftPikUp = $shiftA + $shiftB + $shift3;

        return $sumShiftPikUp;
    }
    public function sumRamRemain()
    {
        $ffbRemain = (float) ($this->sumFFBRemain() ?? 0);
        $pikUpRemain = (float) ($this->sumPikUpRemain() ?? 0);

        return number_format($ffbRemain - $pikUpRemain, 2, '.', ',');
    }
    public function mount()
    {
        $this->Date = Carbon::now()->subDays(1)->format('Y-m-d');
        $this->selectedDate = Carbon::now()->subDays(1)->format('Y-m-d');
    }
    public function changeDate()
    {
        $this->Date = $this->selectedDate;
    }
    public function render()
    {
        $production = Production::whereDate('Date', Carbon::parse($this->Date)->format('Y-m-d'))->first();
        $cs = FFBCountProduction::whereDate('Date', Carbon::parse($this->Date)->format('Y-m-d'))->first();

        if ($this->selectedDate > Carbon::now()->subDays(1)) {
            $this->dispatch(
                'alertwarning',
                position: 'center',
                icon: 'warning',
                title: 'ไม่พบข้อมูลในวันที่ดังกล่าว',
                showConfirmButton: false,
                timer: 1800,
            );
            return view('livewire.pro.report-pro-live');
        }


        if ($production) {
            $this->FFBPurchase = number_format($production->FFBPurchase, 2, '.', ',');
            $this->FFBForward = number_format($production->FFBForward, 2, '.', ',');
            $this->ShiftA = $production->ShiftA   > 0 ? $production->ShiftA : '-';
            $this->ShiftB = $production->ShiftB > 0 ? $production->ShiftB : '-';
            $this->Shift3 = $production->Shift3 > 0 ? $production->Shift3 : '-';

            $this->FFBGoodQty = ($production->FFBGoodQty == 0) ? '-' : number_format($production->FFBGoodQty, 2, '.', ',');
            $this->AvgPikup = number_format($production->AvgPikup, 2);

            $avgPikup = is_numeric($production->AvgPikup) ? (float) $production->AvgPikup : 0;

            $this->tonShiftA = ($production->ShiftA > 0) ? number_format($production->ShiftA * $avgPikup, 2) : '-';
            $this->tonShift3 = ($production->Shift3 > 0) ? number_format($production->Shift3 * $avgPikup, 2) : '-';

            $tonShiftB = $production->FFBGoodQty - ($production->ShiftA * $avgPikup) - ($production->Shift3 * $avgPikup);
            $this->tonShiftB = ($tonShiftB > 0) ? number_format($tonShiftB, 2) : '-';

            $this->StuckIn = $production->StuckIn > 0 ? $production->StuckIn : '-';
            $this->Steam = $production->Steam > 0 ? $production->Steam : '-';
            $this->RawFFB = $production->RawFFB > 0 ? $production->RawFFB : '-';
            $this->FFBRemain = number_format($production->FFBRemain, 2, '.', ',');
            $this->CS1 = optional($cs)->CS1 ?? '-';
            $this->tonCS1 = is_numeric(optional($cs)->CS1) ? number_format(optional($cs)->CS1 * 0.1689, 2) : '-';
            $this->CS2 = optional($cs)->CS2 ?? '-';
            $this->tonCS2 = is_numeric(optional($cs)->CS2) ? number_format(optional($cs)->CS2 * 0.1689, 2) : '-';

            $this->PikupRemain = $production->PikupRemain;
            $this->RamRemain = $production->RamRemain;
            $this->sumPikUpRemain = $this->sumPikUpRemain();
            $this->sumShiftPikUp = $this->sumShiftPikUp() > 0 ? $this->sumShiftPikUp() : '-';

            $RamRemain2 = $production->FFBRemain - $this->sumPikUpRemain;
            $this->RamRemain2 = ($RamRemain2 > 0) ? number_format($RamRemain2, 2) : '-';

            $this->TotalFFB = number_format($production->TotalFFB ?? 0, 2, '.', ',');
        } else {
            $this->tonShiftA = '';
            $this->tonShift3 = '';
            $this->tonShiftB = '';
            $this->FFBGoodQty = '';
        }
        return view('livewire.pro.report-pro-live');
    }
}
