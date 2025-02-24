<?php

namespace App\Livewire\CAR;

use Livewire\Component;
use App\Models\WIN\EMDept;
use App\Models\HRE\Employee;
use Livewire\WithPagination;
use App\Models\CAR\CarReport;
use App\Models\CAR\CarRequest;
use App\Models\WIN\WebappDept;
use App\Events\NotifyProcessed;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Notify\Discord;
use App\Http\Controllers\Notify\Telegram;

class CarRequestLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
        'approveCarRequest' => 'approveCarRequest',
        'rejectCarRequest' => 'rejectCarRequest',
    ];
    public $edit = false;
    public CarRequest $carRequest;
    public $showModal = false;
    public $deleteId;
    public $updateId;
    public $car_id;
    public $user_request;
    public $job_request;
    public $department_request;
    public $status_request = 0;
    public $car_request;
    public $approver_request;
    public $additionalNotes_request = 0;
    public $use_check = 0;
    public $depts = [];
    public $employees = [];
    public $carReports = [];
    public $carRequestId;
    public bool $isLoading = false;

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
    }

    public function resetInputFields()
    {
        //
    }
    public function updatedUseCheck($value)
    {
        $this->use_check = $value ? 1 : 0;
    }
    public function playSound()
    {
        $this->dispatch('playSound');
    }
    public function stopSound()
    {
        $this->dispatch('stopSound');
        $this->closeModal();
    }

    public function mount(CarRequest $carRequest)
    {
        $this->depts = WebappDept::limit(20)->get();
        $this->employees = Employee::orderBy('EmpName', 'asc')->get();
        $this->carReports = CarReport::where('car_card', 1)
            ->orderBy('car_number', 'asc')
            ->get();
        $this->carRequest = $carRequest;
        $this->approver_request = Auth::user()->name;
        $this->user_request = Auth::user()->emp_id;
        $dept = Employee::where('EmpID', Auth::user()->emp_id)->first();
        $this->department_request = $dept->DeptID;
    }

    public function render()
    {
        $carRequests = CarRequest::orderBy('status_request', 'asc')
            ->orderBy('created_at', 'desc') // เรียงวันที่ใหม่ล่าสุดขึ้นก่อน
            ->paginate(10)
            ->withQueryString();

        return view('livewire.car.car-request-live', [
            'carRequests' => $carRequests,
        ]);
    }

    public function saveCarRequest()
    {
        try {
            $validatedData = $this->validate(
                [
                    'user_request' => 'required',
                    'job_request' => 'required',
                    'department_request' => 'required',
                    'additionalNotes_request' => 'nullable',
                    'status_request' => 'nullable',
                ]
            );
            $validatedData['additionalNotes_request'] = $this->additionalNotes_request;
            $validatedData['status_request'] = $this->status_request;

            if ($this->use_check == 0) {
                $validatedData['car_request'] = 28;
            } else {
                $validatedData['car_request'] = $this->car_request;
            }

            CarRequest::create($validatedData);

            $empName = Employee::where('EmpID', '=', $validatedData['user_request'])->get();
            if (!$empName) {
                throw new \Exception('ไม่พบข้อมูลพนักงาน');
            }
            $carReports = CarReport::with(['province'])->where('id', '=', $validatedData['car_request'])->get();
            if (!$carReports) {
                throw new \Exception('ไม่พบข้อมูลรถที่เลือก');
            }

            $message = "แจ้งขออนุญาต" .
                "\n" . "🙎‍♂️ :"  . $empName[0]->EmpName .
                "\n" . "💼 : "  . $this->job_request .
                "\n" . "🚘 : " . $carReports[0]->car_number . " " . $carReports[0]->province->ProvinceName .
                "\n" . "🚘 : " . "http://isanpalm.dyndns.info:8002/car-request";

            event(new NotifyProcessed([
                'position' => "center",
                'icon' => "error",
                'title' => "ไม่พบข้อมูล",
                'text' => "ไม่สามารถเลือกวันที่มากกว่าวันปัจจุบันได้ !",
                'showConfirmButton' => false,
                'timer' => 2500
            ]));

            $Telegram = new Telegram();
            $Telegram->sendToTelegramCarRequest($message);

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

    // public function confirmApprove($id)
    // {
    //     $this->carRequestId = $id;
    //     $carRequest = CarRequest::find($id);
    //     if ($carRequest) {
    //         $this->dispatch('confirmApprove', [
    //             'carRequestId' => $this->carRequestId,
    //             'title' => "ยืนยันการอนุมัติ",
    //         ]);
    //     } else {
    //         session()->flash('error', 'Car Request not found.');
    //     }
    // }

    public function confirmApprove($id)
    {
        $this->carRequestId = $id;
        $carRequest = CarRequest::find($id);
        $nameId = $carRequest->user_request;
        $empName = Employee::where('EmpID', '=', $nameId)->get();
        if ($carRequest) {
            $this->dispatch(
                'confirmApprove',
                carRequestId: $this->carRequestId,
                title: $empName[0]->EmpName . "\n" . "ใช้รถ : " . $carRequest->carReport->car_number . " " . $carRequest->carReport->province->ProvinceName,
                text: "ภารกิจ : " . $carRequest->job_request,
            );
        } else {
            session()->flash('error', 'Car Request not found.');
        }
    }

    public function approveCarRequest()
    {
        $carRequest = CarRequest::find($this->carRequestId);
        if ($carRequest) {
            $carRequest->update([
                'status_request' => 1,
                'approver_request' => Auth::user()->name,
            ]);
            event(new NotifyProcessed([
                'position' => "center",
                'icon' => "error",
                'title' => "ไม่พบข้อมูล",
                'text' => "ไม่สามารถเลือกวันที่มากกว่าวันปัจจุบันได้ !",
                'showConfirmButton' => false,
                'timer' => 2500
            ]));

            session()->flash('message', 'Car Request Approved Successfully.');
        } else {
            session()->flash('error', 'Car Request not found.');
        }
    }

    public function rejectCarRequest()
    {
        $carRequest = CarRequest::find($this->carRequestId);
        if ($carRequest) {
            $carRequest->update([
                'status_request' => 2,
                'approver_request' => Auth::user()->name,
            ]);

            session()->flash('message', 'Car Request Rejected Successfully.');
        } else {
            session()->flash('error', 'Car Request not found.');
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $carRequest = CarRequest::find($id);
        $this->dispatch(
            'alertConfirmDelete',
            [
                'deleteId' => $this->deleteId,
            ]
        );
        if ($carRequest) {
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
        $carRequest = CarRequest::find($this->deleteId);
        if ($carRequest) {
            $carRequest->delete();
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
}
