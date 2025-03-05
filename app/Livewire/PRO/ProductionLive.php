<?php

namespace App\Livewire\PRO;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PRO\Production;
use App\Models\WIN\WebappPOInv;
use Illuminate\Support\Facades\Date;
use App\Models\PRO\FFBCountProduction;

class ProductionLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
        'cancelConfirmed' => 'cancelItem',
    ];
    public $edit = false;
    public Production $production;
    public $showModal = false;
    public $deleteId;
    public $cancelId;
    public $updateId;
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
    public $use_check = 0;
    public bool $isLoading = false;

    public function openModal()
    {
        $this->edit = false;
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModal = false;
    }
    public function updatedUseCheck($value)
    {
        $this->use_check = $value ? 1 : 0;
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
    public function sumFFB()
    {
        $ffbPurchase = is_numeric($this->FFBPurchase) ?  str_replace(',', '', $this->FFBPurchase): 0;
        $ffbForward = str_replace(',', '', $this->FFBForward) ?? 0;

        $this->TotalFFB = $ffbPurchase + $ffbForward;
        return $this->TotalFFB;
    }


    public function avgPikUp()
    {
        $sumFFB = is_numeric($this->sumFFB()) ? $this->sumFFB() : 0;
        $sumShift = is_numeric($this->sumShift()) && $this->sumShift() > 0 ? $this->sumShift() : 1;

        $this->AvgPikup = number_format($sumFFB / $sumShift, 2);

        $AvgPikup = $sumFFB / $sumShift;
        return $AvgPikup;
    }

    public function sumPikUpRemain()
    {
        $stuckIn = is_numeric($this->StuckIn) ? $this->StuckIn : 0;
        $steam = is_numeric($this->Steam) ? $this->Steam : 0;
        $ffbForward = is_numeric($this->FFBForward) ? $this->FFBForward : 0;

        if ($this->FFBGoodQty > 0 ){
            $sumPikUpRemain = ($stuckIn + $steam) * $this->avgPikUp();
        }else{
            $sumPikUpRemain = $ffbForward;
        }

        return $sumPikUpRemain;
    }
    public function sumRamRemain()
    {
        $ffbRemain = (float) ($this->sumFFBRemain() ?? 0);
        $pikUpRemain = (float) ($this->sumPikUpRemain() ?? 0);
        $this->RamRemain2 = number_format($ffbRemain - $pikUpRemain, 2);

        return $this->RamRemain2;
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
    public function sumFFBRemain()
    {
        $this->FFBRemain = number_format($this->sumFFB() - $this->sumFFBGoodQty(), 2, '.', ',');
        return $this->FFBRemain;
    }

    public function mount()
    {
        $this->Date = Carbon::now()->subDays(1)->format('Y-m-d');
        $this->changeDate();
    }
    public  function changeDate()
    {
        $subProduction = Production::whereDate('Date', Carbon::parse($this->Date)->subDays(1)->format('Y-m-d'))
            ->whereNotNull('FFBRemain')
            ->get();
        $this->FFBForward = $subProduction->isNotEmpty() ? number_format($subProduction[0]->FFBRemain, 2, '.', ',')  : 0;
        $sumFFBSubDay = WebappPOInv::whereDate('DocuDate', $this->Date)
            ->selectRaw('SUM(CAST(GoodNet AS DECIMAL(10, 2))) as total')
            ->first()
            ->total ?? 0;
        $this->FFBPurchase = number_format($sumFFBSubDay / 1000, 2, '.', ',');
        $this->ShiftA = FFBCountProduction::whereDate('Date', $this->Date)->where('Shift', 'A')->sum('Quantity') ?? 0;
        $this->ShiftB = FFBCountProduction::whereDate('Date', $this->Date)->where('Shift', 'B')->sum('Quantity') ?? 0;
        $this->Shift3 = FFBCountProduction::whereDate('Date', $this->Date)->where('Shift', '3')->sum('Quantity') ?? 0;
        $this->updateUseCheck();
    }
    public function updateUseCheck()
    {
        $shiftA = (float) ($this->ShiftA ?? 0);
        $shiftB = (float) ($this->ShiftB ?? 0);
        $shift3 = (float) ($this->Shift3 ?? 0);

        $this->use_check = ($shiftA > 0 || $shiftB > 0 || $shift3 > 0) ? 1 : 0;
    }
    public function render()
    {
        $productions = Production::latest()->paginate(10);
        return view('livewire.pro.production-live', [
            'productions' => $productions
        ]);
    }
    public function resetInputFields()
    {
        $this->Date = '';
        $this->FFBPurchase = '';
        $this->FFBForward = '';
        $this->ShiftA = '';
        $this->ShiftB = '';
        $this->Shift3 = '';
        $this->PikupRemain = '';
        $this->RamRemain = '';
        $this->TotalFFB = '';
        $this->AvgPikup = '';
        $this->FFBGoodQty = '';
        $this->StuckIn = '';
        $this->Steam = '';
        $this->PikupRemain2 = '';
        $this->RamRemain2 = '';
        $this->RawFFB = '';
        $this->FFBRemain = '';
        $this->CS1 = '';
        $this->CS2 = '';
    }
    public function saveProduction()
    {
        try {
            $validatedData = $this->validate([
                'Date' => 'required',
                'FFBForward' => 'required',
                'FFBPurchase' => 'required',
                'ShiftA' => 'nullable',
                'ShiftB' => 'nullable',
                'Shift3' => 'nullable',
                'PikupRemain' => 'nullable',
                'RamRemain' => 'nullable',
                'AvgPikup' => 'nullable',
                'FFBGoodQty' => 'nullable',
                'StuckIn' => 'nullable',
                'Steam' => 'nullable',
                'RawFFB' => 'nullable',
                'FFBRemain' => 'nullable',
                'CS1' => 'nullable',
                'CS2' => 'nullable',
                'PikupRemain2' => 'nullable',
            ]);
            $validatedData['TotalFFB'] = $this->sumFFB();
            $validatedData['FFBGoodQty'] = str_replace(',', '', number_format($this->sumFFBGoodQty(), 2));
            $validatedData['FFBRemain'] = str_replace(',', '', $this->sumFFBRemain());
            $validatedData['RamRemain2'] = $this->sumRamRemain();

            Production::create($validatedData);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModal();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch(
                'alert',
                position: "center",
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModal();
        }
    }

    public function confirmEdit($id)
    {
        $this->showModal = true;
        $this->edit = true;
        $this->updateId = $id;
        $this->production = Production::find($id);
        if ($this->production) {
            $this->Date = date_format(date_create($this->production->Date), "Y-m-d");
        }
        $this->FFBPurchase = number_format($this->production->FFBPurchase, 2, '.', ',');
        $this->FFBForward = number_format($this->production->FFBForward, 2, '.', ',');
        $this->ShiftA = $this->production->ShiftA;
        $this->ShiftB = $this->production->ShiftB;
        $this->Shift3 = $this->production->Shift3;
        $this->PikupRemain = $this->production->PikupRemain;
        $this->RamRemain = $this->production->RamRemain;
        $this->AvgPikup = number_format($this->production->AvgPikup, 2);
        $this->FFBGoodQty = number_format($this->production->FFBGoodQty, 2, '.', ',');
        $this->StuckIn = $this->production->StuckIn;
        $this->Steam = $this->production->Steam;
        $this->RawFFB = $this->production->RawFFB;
        $this->FFBRemain = number_format($this->production->FFBRemain, 2, '.', ',');
    }

    public function updateProduction()
    {
        try {
            $validatedData = $this->validate([
                'Date' => 'required',
                'FFBForward' => 'required',
                'FFBPurchase' => 'required',
                'ShiftA' => 'nullable',
                'ShiftB' => 'nullable',
                'Shift3' => 'nullable',
                'PikupRemain' => 'nullable',
                'RamRemain' => 'nullable',
                'AvgPikup' => 'nullable',
                'FFBGoodQty' => 'nullable',
                'StuckIn' => 'nullable',
                'Steam' => 'nullable',
                'RawFFB' => 'nullable',
                'FFBRemain' => 'nullable',
                'CS1' => 'nullable',
                'CS2' => 'nullable',
                'PikupRemain2' => 'nullable',
            ]);
            $production = Production::find($this->updateId);
            $validatedData['TotalFFB'] = $this->sumFFB();
            $validatedData['FFBGoodQty'] = str_replace(',', '', number_format($this->sumFFBGoodQty(), 2));
            $validatedData['FFBRemain'] = str_replace(',', '', $this->sumFFBRemain());
            $validatedData['RamRemain2'] = $this->sumRamRemain();
dd($validatedData);
            $production->update($validatedData);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModal();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch(
                'alert',
                position: "center",
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModal();
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $production = Production::find($id);

        if ($production) {
            $this->dispatch(
                'alertConfirmDelete',
                [
                    'deleteId' => $this->deleteId,
                ]
            );
        } else {
            // จัดการกรณีที่ไม่พบผู้ใช้
            session()->flash('error', 'User not found.');
        }
    }

    public function deleteItem()
    {
        $production = Production::find($this->deleteId);
        if ($production) {
            $production->delete();
            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "ลบข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1600
            );
            $this->mount();
        } else {
            $this->dispatch(
                'alert',
                position: "center",
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                showConfirmButton: false,
                timer: 1500
            );
        }
    }
}
