<?php

namespace App\Livewire\CAR;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\CAR\UseCar;
use App\Models\HRE\Employee;
use Livewire\WithPagination;
use App\Models\CAR\CarReport;
use App\Models\CAR\CarRequest;
use App\Events\NotifyProcessed;
use App\Models\WIN\EMDept;

class UseCarLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
    ];
    public $edit = false;
    public $showModal = false;
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
    }

    public function mount()
    {
        //
    }
    public function notify()
    {
        event(new NotifyProcessed([
            'position' => "center",
            'icon' => "error",
            'title' => "ไม่พบข้อมูล",
            'text' => "ไม่สามารถเลือกวันที่มากกว่าวันปัจจุบันได้ !",
            'showConfirmButton' => false,
            'timer' => 2500
        ]));
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
}
