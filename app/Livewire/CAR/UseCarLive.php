<?php

namespace App\Livewire\CAR;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\CAR\UseCar;
use App\Models\WIN\EMDept;
use App\Models\HRE\Employee;
use Livewire\WithPagination;
use App\Models\CAR\CarReport;
use App\Models\CAR\CarRequest;
use App\Events\NotifyProcessed;
use App\Http\Controllers\Notify\Telegram;

class UseCarLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
    ];
    public $edit = false;
    public $showModal = false;
    public $showModalEnd = false;
    public $deleteId;
    public $updateId;
    public UseCar $useCar;
    public $card_id;
    public $car_id;
    public $user_request;
    public $use_job;
    public $use_start;
    public $use_end;
    public $use_distance;
    public $use_status;
    public $endId;
    public $carId;
    public $user_name;
    public $car;
    public $car_mileage;
    public $car_province;
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
        $this->edit = false;
    }

    public function openModalEnd()
    {
        $this->edit = false;
        $this->showModalEnd = true;
    }
    public function closeModalEnd()
    {
        $this->resetInputFields();
        $this->showModalEnd = false;
        $this->edit = false;
    }
    public function resetInputFields()
    {
        $this->use_end = '';
    }

    public function mount()
    {
        //
    }

    public function render()
    {
        Carbon::setLocale('th');
        $carReports = CarReport::with(['province', 'brand'])->orderBy('id', 'desc')->get();
        $carRequests = CarRequest::with(['employee', 'emDept', 'carReport'])
            ->where(function ($query) {
                $query->where('additionalNotes_request', '!=', 1)
                    ->orWhereNull('additionalNotes_request');
            })
            ->orderBy('id', 'desc')
            ->get();
        $useCars = UseCar::with(['employee', 'emDept', 'carReport'])
            ->orderBy('use_status', 'asc') // เรียงตามสถานะ
            ->orderBy('id', 'desc') // เรียงวันที่จากล่าสุด
            ->paginate(10);
        $users = Employee::orderBy('EmpName', 'ASC')->get();
        $departments = EMDept::orderBy('DeptID', 'ASC')->get();
        return view('livewire.car.use-car-live', [
            'carRequests' => $carRequests,
            'departments' => $departments,
            'carReports' => $carReports,
            'users' => $users,
            'useCars' => $useCars,
        ]);
    }

    public function addCarUse($id)
    {
        try {
            $carRequest = CarRequest::findOrFail($id);
            $carReport = CarReport::findOrFail($carRequest->car_request);

            // กำหนดค่าตัวแปร
            $this->user_request = $carRequest->user_request;
            $this->car_id = $carRequest->car_request;
            $this->use_job = $carRequest->job_request;
            $this->use_start = $carReport->car_mileage;
            $this->use_status = 1;
            $this->card_id = '';

            // บันทึกข้อมูลการใช้รถ
            $useCar = UseCar::create([
                'card_id' => $this->card_id,
                'user_request' => $this->user_request,
                'car_id' => $this->car_id,
                'use_job' => $this->use_job,
                'use_start' => $this->use_start,
                'use_status' => $this->use_status,
            ]);

            // ตรวจสอบข้อมูลพนักงาน
            $empName = Employee::where('EmpID', $useCar->user_request)->get();
            if ($empName->isEmpty()) {
                throw new \Exception('ไม่พบข้อมูลพนักงาน');
            }

            // ตรวจสอบข้อมูลรถ
            $carReports = CarReport::with(['province'])->where('id', $this->car_id)->get();
            if ($carReports->isEmpty()) {
                throw new \Exception('ไม่พบข้อมูลรถที่เลือก');
            }

            // สร้างข้อความแจ้งเตือน
            $header = "🔴 ออกนอกบริษัท 🔴";
            $user_name = $empName[0]->EmpName;
            $job = $useCar->use_job;
            $car_number = $carReports[0]->car_number . " " . $carReports[0]->province->ProvinceName;
            $use_start = $useCar->use_start;
            $message = $header .
                "\n" . "🙋‍♂️ : " . $user_name .
                "\n" . "💼 : "  . $job .
                "\n" . "🚘 : " . $car_number .
                "\n" . "📟 : " . $use_start ;

            // ส่งข้อความไปยัง Telegram
            $Telegram = new Telegram();
            $Telegram->sendToTelegramPassCar($message);

            // อัปเดตสถานะคำขอรถ
            $carRequest->update([
                'additionalNotes_request' => 1,
            ]);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModal();
        } catch (\Exception $e) {
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

    public function end($id)
    {
        $this->showModalEnd = true;
        $this->endId = $id;
        $useCar = UseCar::with(['employee', 'carReport'])->findOrFail($id);
        $carReports = CarReport::with(['province'])->findOrFail($useCar->carReport->id);
        $this->car_mileage = $carReports->car_mileage;

        $carId = CarReport::findOrFail($useCar->car_id);
        $this->carId = $carId->id;
        $this->user_request = $useCar->user_request;
        $this->user_name = $useCar->employee->EmpName;
        $this->car = $useCar->carReport->car_number;
        $this->car_province = $carReports->province->ProvinceName;
        $this->car_id = $useCar->car_request;
        $this->use_job = $useCar->job_request;
    }

    public function editEnd($id)
    {
        $this->showModalEnd = true;
        $this->edit = true;
        $this->endId = $id;
        $useCar = UseCar::with(['employee', 'carReport'])->findOrFail($id);
        $carReports = CarReport::with(['province'])->findOrFail($useCar->carReport->id);
        $this->car_mileage = $carReports->car_mileage;

        $carId = CarReport::findOrFail($useCar->car_id);
        $this->carId = $carId->id;
        $this->user_request = $useCar->user_request;
        $this->user_name = $useCar->employee->EmpName;
        $this->car = $useCar->carReport->car_number;
        $this->car_province = $carReports->province->ProvinceName;
        $this->car_id = $useCar->car_request;
        $this->use_job = $useCar->job_request;
    }

    public function saveCarEnd()
    {
        try {
            $validatedData = $this->validate([
                'use_end' => 'required',
                'use_status' => 'nullable',
            ]);
            $useCar = UseCar::findOrFail($this->endId);
            $carReport = CarReport::findOrFail($this->carId);

            $validatedData['use_status'] = 2;
            $validatedData['use_distance'] = $this->use_end - $useCar->use_start;

            $useCar->update($validatedData);

            $carReport->update([
                'car_mileage' => $this->use_end,
            ]);

            $empName = Employee::where('EmpID', '=', $this->user_request)->get();
            if (!$empName) {
                throw new \Exception('ไม่พบข้อมูลพนักงาน');
            }
            $carReports = CarReport::with(['province'])->where('id', '=', $this->carId)->get();
            if (!$carReports) {
                throw new \Exception('ไม่พบข้อมูลรถที่เลือก');
            }

            $header = "🟢 เสร็จภารกิจ 🟢";
            $user_name = $empName[0]->EmpName;
            $jop = $useCar->use_job;
            $car_number = $carReports[0]->car_number . " " . $carReports[0]->province->ProvinceName;
            $use_start = $useCar->use_start;
            $use_end = $this->use_end;

            $message = $header .
                "\n" . "🙋‍♂️ : " . $user_name .
                "\n" . "💼 : "  . $jop .
                "\n" . "🚘 : " . $car_number .
                "\n" . "📟 : " . $use_start .
                "\n" . "📟 : " . $use_end ;

            $Telegram = new Telegram();
            $Telegram->sendToTelegramPassCar($message);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModalEnd();
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

    public function updateCarEnd()
    {
        try {
            $validatedData = $this->validate([
                'use_end' => 'required',
                'use_status' => 'nullable',
            ]);
            $useCar = UseCar::findOrFail($this->endId);
            $carReport = CarReport::findOrFail($this->carId);

            $validatedData['use_status'] = 2;
            $validatedData['use_distance'] = $this->use_end - $useCar->use_start;

            $useCar->update($validatedData);

            $carReport->update([
                'car_mileage' => $this->use_end,
            ]);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "แก้ไขข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModalEnd();
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
}
