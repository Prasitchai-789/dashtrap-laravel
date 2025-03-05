<?php

namespace App\Livewire\PRO;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPSTORM_META\type;
use App\Models\PRO\FFBCountProduction;

class FFBCountProductionLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
        'cancelConfirmed' => 'cancelItem',
    ];
    public $edit = false;
    public FFBCountProduction $ffbCountProduction;
    public $showModal = false;
    public $deleteId;
    public $cancelId;
    public $updateId;
    public $numberOfInputs = 2;
    public bool $isLoading = false;
    public
        $FFBProduction_id,
        $delete_id,
        $Date,
        $Shift,
        $StartTime,
        $FinishTime,
        $Quantity,
        $DatePalm1,
        $Contain1,
        $DatePalm2,
        $Contain2,
        $DatePalm3,
        $Contain3,
        $PikupForward,
        $RawFFB,
        $CS1,
        $CS2,
        $FlowMeterBefore,
        $FlowMeterAfter,
        $Amount,
        $Remark,
        $Add1,
        $Add2;
    public function initLoading()
    {
        $this->isLoading = true;
    }
    public function openModal()
    {
        $this->edit = false;
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModal = false;
        $this->numberOfInputs = 1;
    }

    public function increment()
    {
        $this->numberOfInputs++;
    }

    public function decrement()
    {
        if ($this->numberOfInputs > 1) {
            $this->numberOfInputs--;
        }
    }
   public function updatedFlowMeterBefore()
    {
        $this->FlowMeterBefore = $this->formatNumber($this->FlowMeterBefore);
    }

    public function updatedFlowMeterAfter()
    {
        $this->FlowMeterAfter = $this->formatNumber($this->FlowMeterAfter);
    }

    private function formatNumber($value)
    {
        // ลบ comma ออกก่อนแล้วแปลงเป็น float
        $number = (float) str_replace(',', '', $value);
        // แปลงกลับเป็น string พร้อม comma และทศนิยม 2 ตำแหน่ง
        return number_format($number, 2);
    }
    public function mount()
    {
        $this->resetInputFields();
        $this->DatePalm1 = Carbon::now()->subDays(1)->format('Y-m-d');
    }
    public function render()
    {
        $this->Date = date('Y-m-d');
        $ffbCountProductions = FFBCountProduction::orderBy('id', 'desc')->paginate(10);
        return view('livewire.pro.FFB-count-production-live', [
            'ffbCountProductions' => $ffbCountProductions
        ]);
    }

    public function calculate_str_replace()
    {
        $FlowMeterAfter = (float) str_replace(',', '', $this->FlowMeterAfter);
        $FlowMeterBefore = (float) str_replace(',', '', $this->FlowMeterBefore);
        return (float) ($FlowMeterAfter - $FlowMeterBefore);
    }

    public function resetInputFields()
    {
        $this->Shift = '';
        $this->StartTime = '';
        $this->FinishTime = '';
        $this->Quantity = '';
        $this->DatePalm1 = '';
        $this->Contain1 = '';
        $this->DatePalm2 = '';
        $this->Contain2 = '';
        $this->DatePalm3 = '';
        $this->Contain3 = '';
        $this->PikupForward = '';
        $this->RawFFB = '';
        $this->CS1 = '';
        $this->CS2 = '';
        $this->FlowMeterBefore = '';
        $this->FlowMeterAfter = '';
    }
    public function saveFFBCount()
    {
        try {
            $validatedData = $this->validate([
                'Date' => 'required',
                'Shift' => 'required',
                'StartTime' => 'required',
                'FinishTime' => 'required',
                'Quantity' => 'required',
                'DatePalm1' => 'required',
                'Contain1' => 'required',
                'DatePalm2' => 'nullable',
                'Contain2' => 'nullable',
                'DatePalm3' => 'nullable',
                'Contain3' => 'nullable',
                'PikupForward' => 'required',
                'RawFFB' => 'required',
                'CS1' => 'required',
                'CS2' => 'required',
                'FlowMeterBefore' => 'required',
                'FlowMeterAfter' => 'required',
            ]);
            $validatedData['Amount'] = $this->calculate_str_replace();

            FFBCountProduction::create($validatedData);

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
        $this->ffbCountProduction = FFBCountProduction::find($id);
        if ($this->ffbCountProduction) {
            $this->Date = date_format(date_create($this->ffbCountProduction->Date), "Y-m-d");
        }
        $this->Shift = $this->ffbCountProduction->Shift;
        if ($this->ffbCountProduction) {
            $this->StartTime = date_format(date_create($this->ffbCountProduction->StartTime), "H:i");
        }
        if ($this->ffbCountProduction) {
            $this->FinishTime = date_format(date_create($this->ffbCountProduction->FinishTime), "H:i");
        }
        $this->Quantity = $this->ffbCountProduction->Quantity;
        if ($this->ffbCountProduction) {
            $this->DatePalm1 = date_format(date_create($this->ffbCountProduction->DatePalm1), "Y-m-d");
        }
        $this->Contain1 = $this->ffbCountProduction->Contain1;

        if ($this->ffbCountProduction) {
            $this->DatePalm2 = $this->ffbCountProduction->DatePalm2;
        }
        $this->Contain2 = $this->ffbCountProduction->Contain2;
        if ($this->ffbCountProduction) {
            $this->DatePalm3 = $this->ffbCountProduction->DatePalm3;
        }
        $this->Contain3 = $this->ffbCountProduction->Contain3;
        $this->PikupForward = $this->ffbCountProduction->PikupForward;
        $this->RawFFB = $this->ffbCountProduction->RawFFB;
        $this->CS1 = $this->ffbCountProduction->CS1;
        $this->CS2 = $this->ffbCountProduction->CS2;
        $this->FlowMeterBefore = number_format($this->ffbCountProduction->FlowMeterBefore, 2, '.', ',');
        $this->FlowMeterAfter = number_format($this->ffbCountProduction->FlowMeterAfter, 2, '.', ',');
    }

    public function updateFFBCount()
    {
        try {
            $validatedData = $this->validate([
                'Date' => 'required',
                'Shift' => 'required',
                'StartTime' => 'required',
                'FinishTime' => 'required',
                'Quantity' => 'required',
                'DatePalm1' => 'required',
                'Contain1' => 'required',
                'DatePalm2' => 'nullable',
                'Contain2' => 'nullable',
                'DatePalm3' => 'nullable',
                'Contain3' => 'nullable',
                'PikupForward' => 'required',
                'RawFFB' => 'required',
                'CS1' => 'required',
                'CS2' => 'required',
                'FlowMeterBefore' => 'required',
                'FlowMeterAfter' => 'required',
            ]);

            $ffbCountProduction = FFBCountProduction::find($this->updateId);
            $validatedData['FlowMeterBefore'] = (float) str_replace(',', '', $this->FlowMeterBefore);
            $validatedData['FlowMeterAfter'] = (float) str_replace(',', '', $this->FlowMeterAfter);
            $validatedData['Amount'] = $this->calculate_str_replace();
            $ffbCountProduction->update($validatedData);

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
        $ffbCountProduction = FFBCountProduction::find($id);

        if ($ffbCountProduction) {
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
        $ffbCountProduction = FFBCountProduction::find($this->deleteId);
        if ($ffbCountProduction) {
            $ffbCountProduction->delete();
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
