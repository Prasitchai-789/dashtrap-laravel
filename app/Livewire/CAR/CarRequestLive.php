<?php

namespace App\Livewire\CAR;

use Livewire\Component;
use Livewire\WithPagination;
use App\Events\NotifyProcessed;
use App\Models\CAR\CarRequest;

class CarRequestLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
    ];
    public $edit = false;
    public CarRequest $carRequest;
    public $showModal = false;
    public $deleteId;
    public $updateId;
    public $car_id;
    public $user_request;
    public $use_job;
    public $use_start;
    public $use_end;
    public $use_distance;
    public $use_status;
    public $additionalNotes;
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
        $carRequests = CarRequest::orderBy('id', 'desc')->paginate(10)->withQueryString();
        return view('livewire.car.car-request-live', [
            'carRequests' => $carRequests,
        ]);
    }
}
