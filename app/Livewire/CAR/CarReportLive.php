<?php

namespace App\Livewire\CAR;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\WIN\EMDept;
use App\Models\CAR\CarType;
use App\Models\CAR\CarBrand;
use Livewire\WithPagination;
use App\Models\CAR\CarReport;
use Livewire\WithFileUploads;
use App\Events\NotifyProcessed;
use App\Models\CAR\CarCharacter;
use App\Models\Location\Province;
use App\Http\Controllers\Notify\Telegram;

class CarReportLive extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['deleteConfirmed' => 'deleteItem'];
    public $edit = false;
    public $showModal = false;
    public $deleteId;
    public $updateId;
    public CarReport $carReport;
    public $car_number;
    public $car_county;
    public $car_type;
    public $car_character;
    public $car_brand;
    public $car_model;
    public $car_year;
    public $car_color;
    public $car_fuel;
    public $car_mileage;
    public $car_date;
    public $car_buy;
    public $car_tax;
    public $car_insurance;
    public $car_photo;
    public $car_status = 0;
    public $car_details;
    public $car_character_list;
    public $car_type_list;
    public $car_brand_list;
    public $car_department;
    public $car_card = 0;
    public $carTypes = [];
    public $carCharacters = [];
    public $carBrands = [];
    public $provinces = [];
    public $departments = [];

    protected $rules = [
        'car_number' => 'required|string|max:255',
        'car_county' => 'required|string|max:255',
        'car_type' => 'required|string|max:255',
        'car_character' => 'nullable|string|max:255',
        'car_brand' => 'nullable|string|max:255',
        'car_model' => 'nullable|string|max:255',
        'car_year' => 'nullable|string',
        'car_color' => 'nullable|string|max:100',
        'car_fuel' => 'nullable|string|max:100',
        'car_mileage' => 'nullable|string',
        'car_date' => 'nullable|date',
        'car_buy' => 'nullable|date',
        'car_tax' => 'nullable|date',
        'car_insurance' => 'nullable|date',
        'car_photo' => 'nullable|image|max:3072',
        'car_status' => 'boolean',
        'car_details' => 'nullable|string',
        'car_department' => 'nullable|string',
        'car_card' => 'nullable|string',
    ];

    public function pusher() {}
    public function mount(CarReport $carReport)
    {
        $this->carReport = $carReport;
        $this->carTypes = CarType::orderBy('id', 'desc')->get();
        $this->carCharacters = CarCharacter::orderBy('id', 'desc')->get();
        $this->carBrands = CarBrand::orderBy('id', 'ASC')->get();
        $this->provinces = Province::orderBy('ProvinceName', 'ASC')->get();
        $this->departments = EMDept::orderBy('DeptID', 'ASC')->get();
    }

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
        $this->car_number = '';
        $this->car_county = '';
        $this->car_type = '';
        $this->car_character = '';
        $this->car_brand = '';
        $this->car_model = '';
        $this->car_year = '';
        $this->car_color = '';
        $this->car_fuel = '';
        $this->car_mileage = '';
        $this->car_date = '';
        $this->car_buy = '';
        $this->car_tax = '';
        $this->car_insurance = '';
        $this->car_photo = '';
        $this->car_status = '';
        $this->car_details = '';
        $this->car_department = '';
        $this->car_card = '';
    }
    public function render()
    {
        Carbon::setLocale('th');
        $carReports = CarReport::with(['province', 'brand'])->orderBy('id', 'desc')->paginate(10);

        return view('livewire.car.car-report-live', [
            'carReports' => $carReports,
        ]);
    }

    public function saveCarReport()
    {
        try {
            $validatedData = $this->validate([
                'car_number' => 'required|string|max:255',
                'car_county' => 'required|string|max:255',
                'car_type' => 'required|string|max:255',
                'car_character' => 'nullable|string|max:255',
                'car_brand' => 'nullable|string|max:255',
                'car_model' => 'nullable|string|max:255',
                'car_year' => 'nullable|string',
                'car_color' => 'nullable|string|max:100',
                'car_fuel' => 'nullable|string|max:100',
                'car_mileage' => 'nullable|string',
                'car_date' => 'nullable|date',
                'car_buy' => 'nullable|date',
                'car_tax' => 'nullable|date',
                'car_insurance' => 'nullable|date',
                'car_photo' => 'nullable|image|max:3072',
                'car_status' => 'boolean',
                'car_details' => 'nullable|string',
                'car_department' => 'nullable|string',
            ]);

            if ($validatedData) {
                dd($validatedData);

                CarReport::create($validatedData);

                $message = "แจ้งขออนุญาต" .
                    "\n" . "🙎‍♂️ :"  . 1 .
                    "\n" . "💼 : "  . $this->job_request .
                    "\n" . "🚘 : ";

                $Telegram = new Telegram();
                $Telegram->sendToTelegram($message);

                event(new NotifyProcessed([
                    'position' => "center",
                    'icon' => "error",
                    'title' => "ไม่พบข้อมูล",
                    'text' => "ไม่สามารถเลือกวันที่มากกว่าวันปัจจุบันได้ !",
                    'showConfirmButton' => false,
                    'timer' => 2500
                ]));

                $this->dispatch(
                    'alert',
                    position: "center",
                    icon: "success",
                    title: "บันทึกข้อมูลสำเร็จ",
                    showConfirmButton: false,
                    timer: 1500
                );

                $this->closeModal();

            } else {
                $this->dispatch(
                    'alert',
                    position: "center",
                    icon: "error",
                    title: "บันทึกไม่ได้",
                    showConfirmButton: false,
                    timer: 1500
                );
                $this->closeModal();
            }
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
