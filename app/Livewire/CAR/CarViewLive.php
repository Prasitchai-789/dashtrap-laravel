<?php

namespace App\Livewire\CAR;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\CAR\CarRepair;
use App\Models\CAR\CarReport;
use Livewire\WithFileUploads;

class CarViewLive extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['deleteConfirmed' => 'deleteItem'];
    public $edit = false;
    public $showModalRepair = false;
    public $deleteId;
    public $updateId;
    public CarReport $carReport;
    public CarRepair $carRepair;
    public $car_photo;
    public $carReportId;
    public $car_id;
    public $car_issue;
    public $car_plan = 1;
    public $car_canDrive;
    public $car_lastMaintenanceDate;
    public $car_preferredRepairDate;
    public $car_garage;
    public $car_warrantyInfo;
    public $car_additionalNotes;
    public $car_requesterName;
    public $today;
    public $sevenDaysLater;
    public function openModalRepair()
    {
        $this->edit = false;
        $this->showModalRepair = true;
        $carReport = CarReport::findOrFail($this->carReportId);
        $this->car_id = $carReport->car_number . " " . $carReport->province->ProvinceName;
        $this->car_canDrive = $carReport->car_status;
    }
    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModalRepair = false;
    }
    public function resetInputFields()
    {
        $this->car_id = '';
        $this->car_issue = '';
        $this->car_plan = '';
        $this->car_canDrive = '';
        $this->car_lastMaintenanceDate = '';
        $this->car_preferredRepairDate = '';
        $this->car_garage = '';
        $this->car_warrantyInfo = '';
        $this->car_additionalNotes = '';
        $this->car_requesterName = '';
    }

    public function mount()
{
    $this->carReportId = session('carReportId');
    $carReport = CarReport::find($this->carReportId);

    if ($carReport) {
        $this->car_canDrive = $carReport->car_status;
    } else {
        $this->car_canDrive = null;
    }
}


    public function updateCarStatus()
    {
        //
    }

    public function render()
    {
        Carbon::setLocale('th');
        $this->today = Carbon::now('Asia/Bangkok');
        $this->sevenDaysLater = $this->today->copy()->addDays(7); // ปัจจุบัน + 7 วัน
        $carRepairs = CarRepair::where('car_id',  $this->carReportId)
            ->orderBy('id', 'desc')
            ->get();
        $carReportList = CarReport::where('id',  $this->carReportId)
            ->orderBy('id', 'desc')
            ->get();
        return view('livewire.car.car-view-live', [

            'carReportList' => $carReportList,
            'carRepairs' => $carRepairs,
        ]);
    }

    public function saveCarRepair()
    {

        try {
            $validatedData = $this->validate([
                'car_issue' => 'required|string|max:255',
                // 'car_plan' => 'boolean',
                'car_canDrive' => 'boolean',
                'car_lastMaintenanceDate' => 'required|date',
                'car_preferredRepairDate' => 'required|date',
                'car_garage' => 'nullable|string',
                'car_warrantyInfo' => 'nullable|date|max:100',
                'car_additionalNotes' => 'nullable|string|max:100',
                'car_requesterName' => 'nullable|string',
            ]);
            $validatedData['car_id'] = $this->carReportId;
            $carReport = CarReport::findOrFail($this->carReportId);
            $carReport->update([
                'car_status' => $this->car_canDrive,
            ]);
            CarRepair::create($validatedData);

            $this->closeModal();
            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
            session()->flash('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
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

    public function confirmEdit($id)
    {
        $this->showModalRepair = true;
        $this->edit = true;
        $this->updateId = $id;
        $carRepair = CarRepair::findOrFail($id);
        $carReport = CarReport::findOrFail($carRepair->car_id);
        $this->car_id = $carReport->car_number . " " . $carReport->province->ProvinceName;
        $this->car_issue = $carRepair->car_issue;
        $this->car_plan = $carRepair->car_plan;
        $this->car_canDrive = $carRepair->car_canDrive;
        $this->car_lastMaintenanceDate = $carRepair->car_lastMaintenanceDate ? date_format(date_create($carRepair->car_lastMaintenanceDate), "Y-m-d") : null;
        $this->car_preferredRepairDate = $carRepair->car_preferredRepairDate ? date_format(date_create($carRepair->car_preferredRepairDate), "Y-m-d") : null;
        $this->car_garage = $carRepair->car_garage;
        $this->car_warrantyInfo = $carRepair->car_warrantyInfo ? date_format(date_create($carRepair->car_warrantyInfo), "Y-m-d") : null;
        $this->car_additionalNotes = $carRepair->car_additionalNotes;
        $this->car_requesterName = $carRepair->car_requesterName;
    }

    public function updateCarRepair()
    {
        try {
            $validatedData = $this->validate([
                'car_issue' => 'required|string|max:255',
                // 'car_plan' => 'boolean',
                'car_canDrive' => 'boolean',
                'car_lastMaintenanceDate' => 'required|date',
                'car_preferredRepairDate' => 'required|date',
                'car_garage' => 'nullable|string',
                'car_warrantyInfo' => 'nullable|date|max:100',
                'car_additionalNotes' => 'nullable|string|max:100',
                'car_requesterName' => 'nullable|string',
            ]);

            $carRepair = CarRepair::findOrFail($this->updateId);

            $carReport = CarReport::findOrFail($this->carReportId);
            $carReport->update([
                'car_status' => $this->car_canDrive,
            ]);

            $carRepair->update($validatedData);

            $this->closeModal();
            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );
        } catch (\Exception $e) {
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
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $carRepair = CarRepair::find($id);

        if ($carRepair) {
            $this->dispatch('alertConfirmDelete', [
                'deleteId' => $this->deleteId,
            ]);
        } else {
            session()->flash('error', 'Report Car not found.');
        }
    }
    public function deleteItem()
    {
        $carRepair = CarRepair::find($this->deleteId);

        if ($carRepair) {
            $carRepair->delete();

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "ลบข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );
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
