<?php

namespace App\Livewire\Technician;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\HRE\Employee;
use Livewire\WithPagination;
use App\Models\Technician\TypeWork;
use App\Models\Technician\WorkOrder;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Notify\Telegram;

class WorkOrderLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['deleteConfirmed' => 'deleteItem'];
    public $edit = false;
    public $showModal = false;
    public $showModalTechnician = false;
    public WorkOrder $workOrder;
    public $deleteId;
    public $updateId;
    public $typeWork;
    public $filterType = "";
    public $NameOfInformant;
    public $Status = 1;
    public $created_at;
    public $updated_at;
    public $TypeWork;
    public $Number;
    public $MachineName;
    public $MachineCode;
    public $Detail;
    public $Location;
    public $Telephone;
    public $WorkStatus;
    public $Technician;
    public $RepairReport;
    public $RepairDate;
    public $Remark;
    public $Image;
    public $count1 = 0;
    public $count2 = 0;
    public $count3 = 0;
    public $count4 = 0;

    public function openModal()
    {
        $this->edit = false;
        $this->showModal = true;
    }
    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModal = false;
        $this->showModalTechnician = false;
    }
    public function resetInputFields()
    {
        $this->NameOfInformant = '';
        $this->Status = '';
        $this->TypeWork = '';
        $this->Number = '';
        $this->MachineName = '';
        $this->MachineCode = '';
        $this->Detail = '';
        $this->Location = '';
        $this->WorkStatus = '';
        $this->Technician = '';
        $this->RepairReport = '';
        $this->RepairDate = '';
        $this->Remark = '';
        $this->Telephone = '';
        $this->Image = '';
    }

    public function mount(WorkOrder $workOrder)
    {
        $this->workOrder = $workOrder;
        $emp = Employee::where('EmpID', Auth::user()->emp_id)->first();
        $this->NameOfInformant = $emp->EmpName;
    }
    public function render()
    {
        $workOrders = WorkOrder::orderBy('id', 'desc')
            ->paginate(10);
        $this->count1 = WorkOrder::where('Status', 1)->count();
        $this->count2 = WorkOrder::where('Status', 2)->count();
        $this->count3 = WorkOrder::where('Status', 3)->count();
        $this->count4 = WorkOrder::where('Status', 4)->count();
        $typeWorks = TypeWork::orderBy('TypeWorkID', 'ASC')->get();
        return view('livewire.technician.work-order-live', [
            'workOrders' => $workOrders,
            'typeWorks' => $typeWorks,
        ]);
    }
    public function generateReferenceNumber()
    {
        $yearTH = date('Y') + 543;
        $shortYear = substr($yearTH, 2);

        $month = date('m');
        $workOrder = WorkOrder::where('TypeWork', 1)->orderBy('id', 'desc')->first();

        if ($workOrder) {

            $latestNumber = $workOrder->Number;

            $latestNumber = (int)substr($workOrder->Number, -3);
            $newNumber = $latestNumber + 1;
        } else {
            $latestNumber = null;
        }
        $referenceNumber = sprintf('IT%s%s%03d', $shortYear, $month, $newNumber);
        return $referenceNumber;
    }
    public function saveWorkOrder()
    {
        try {
            $validatedData = $this->validate(
                [
                    'NameOfInformant' => 'required',
                    'TypeWork' => 'required',
                    'Status' => 'required',
                    'MachineName' => 'required',
                    'MachineCode' => 'nullable',
                    'Location' => 'nullable',
                    'Telephone' => 'nullable',
                    'Detail' => 'nullable',
                ]
            );
            if ($this->TypeWork == 1) {
                $validatedData['Number'] = $this->generateReferenceNumber();
            } else {
                $validatedData['Number'] = null;
            }
            WorkOrder::create($validatedData);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $type = TypeWork::where('TypeWorkID', $validatedData['TypeWork'])->value('TypeWork'); // ดึงค่า TypeWork โดยตรง

            $message = "แจ้งซ่อม : " . $this->MachineName .
                "\n" . "🙎‍♂️ ผู้แจ้ง: "  . $this->NameOfInformant .
                "\n" . "📋 ประเภท: "  . $type .
                "\n" . "📝 รายละเอียด: "  . $this->Detail .
                "\n" . "🚧 สถานที่: "  . $this->Location  .
                "\n" . "📞 เบอร์: "  . $this->Telephone;

            if ($this->TypeWork == 1) {
                $Telegram = new Telegram();
                $Telegram->sendToTelegramITE($message);
            } else {
                $Telegram = new Telegram();
                $Telegram->sendToTelegramMT($message);
            }




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
        $this->showEdit($id);
    }
    public function changeStatus($id)
    {
        $this->resetInputFields();
        $this->showModalTechnician = true;
        $this->edit = true;
        $this->updateId = $id;
        $this->showEdit($id);
    }

    public function showEdit($id)
    {
        $this->workOrder = WorkOrder::find($id);
        $this->NameOfInformant = $this->workOrder->NameOfInformant;
        // $this->Status = $this->workOrder->Status;
        $this->TypeWork = $this->workOrder->TypeWork;
        $this->Number = $this->workOrder->Number;
        $this->MachineName = $this->workOrder->MachineName;
        $this->MachineCode = $this->workOrder->MachineCode;
        $this->Detail = $this->workOrder->Detail;
        $this->Location = $this->workOrder->Location;
        $this->Telephone = $this->workOrder->Telephone;
        $this->WorkStatus = $this->workOrder->WorkStatus;
        $this->Technician = $this->workOrder->Technician;
        $this->RepairReport = $this->workOrder->RepairReport;
        $this->RepairDate = $this->workOrder->RepairDate;
        $this->Remark = $this->workOrder->Remark;
    }

    public function updateEdit()
    {
        $validatedData = $this->validate(
            [
                'NameOfInformant' => 'required',
                'TypeWork' => 'required',
                'Status' => 'required',
                'MachineName' => 'required',
                'MachineCode' => 'nullable',
                'Location' => 'nullable',
                'Telephone' => 'nullable',
                'Detail' => 'nullable',
            ]
        );
        $workOrder = WorkOrder::findOrFail($this->updateId);

        if ($validatedData['Status'] == 4) {
            $validatedData['WorkStatus'] = "ส่งมอบงาน";
            $validatedData['RepairDate'] = date('Y-m-d H:i:s');
        } else {
            if ($validatedData['Status'] == 5) {
                $validatedData['WorkStatus'] = "ยกเลิก";
                $validatedData['RepairDate'] = date('Y-m-d H:i:s');
            } else {
                $validatedData['WorkStatus'] = "มอบหมายงาน";
                $validatedData['RepairDate'] = date('Y-m-d H:i:s');
            }
        }
        $workOrder->update($validatedData);

        $this->dispatch(
            'alert',
            position: "center",
            icon: "success",
            title: "แก้ไขข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        );

        $this->closeModal();
    }
    public function updateWorkOrder()
    {
        $validatedData = $this->validate(
            [

                'Number' => 'required',
                'Status' => 'required',
                'Technician' => 'required',
                'RepairReport' => 'nullable',
                'Remark' => 'nullable',
            ]
        );
        $workOrder = WorkOrder::findOrFail($this->updateId);

        if ($validatedData['Status'] == 4) {
            $validatedData['WorkStatus'] = "ส่งมอบงาน";
            $validatedData['RepairDate'] = date('Y-m-d H:i:s');
        } else {
            if ($validatedData['Status'] == 5) {
                $validatedData['WorkStatus'] = "ยกเลิก";
                $validatedData['RepairDate'] = date('Y-m-d H:i:s');
            } else {
                $validatedData['WorkStatus'] = "มอบหมายงาน";
                $validatedData['RepairDate'] = date('Y-m-d H:i:s');
            }
        }
        $workOrder->update($validatedData);

        $this->dispatch(
            'alert',
            position: "center",
            icon: "success",
            title: "แก้ไขข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        );

        $this->closeModal();
    }
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $workOrder = WorkOrder::find($id);
        if ($workOrder) {
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
        $workOrder = WorkOrder::find($this->deleteId);
        if ($workOrder) {
            $workOrder->delete();
            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "ลบข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1600
            );
        } else {
            session()->flash('error', 'Computer not found.');
        }
    }
    public function generatePdf($id)
    {
        $workOrder = WorkOrder::find($id);
        if ($workOrder->TypeWork == 1) {

            $this->dispatch(
                'modifyPdf',
                NameOfInformant: $workOrder->NameOfInformant,
                Location: $workOrder->Location,
                MachineName: $workOrder->MachineName,
                Detail: $workOrder->Detail,
                Number: $workOrder->Number,
                RepairReport: $workOrder->RepairReport,
                Technician: $workOrder->Technician,
                Date: Carbon::parse($workOrder->created_at)->locale('th')->translatedFormat('j F Y'),
                updateDate: Carbon::parse($workOrder->updated_at)->locale('th')->translatedFormat('j F Y'),
            );
        } else {
            $this->dispatch(
                'newDispatchAction',
                NameOfInformant: $workOrder->NameOfInformant,
                Location: $workOrder->Location,
                MachineName: $workOrder->MachineName,
                Detail: $workOrder->Detail,
                Number: $workOrder->Number,
                RepairReport: $workOrder->RepairReport,
                Technician: $workOrder->Technician,
            );
        }
    }
}
