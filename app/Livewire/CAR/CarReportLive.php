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
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Notify\Telegram;

class CarReportLive extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['deleteConfirmed' => 'deleteItem'];
    public $edit = false;
    public $showModal = false;
    public $showModalBrand = false;
    public $showModalType = false;
    public $showModalCharacter = false;
    public $deleteId;
    public $updateId;
    public CarReport $carReport;
    public CarBrand $carBrand;
    public CarCharacter $carCharacter;
    public CarType $carType;
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
    public $today;
    public $sevenDaysLater;
    public $photoPath;

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

    public function openModalBrand()
    {
        $this->edit = false;
        $this->showModalBrand = true;
    }

    public function closeModalBrand()
    {
        $this->resetInputFields();
        $this->showModalBrand = false;
    }

    public function openModalType()
    {
        $this->edit = false;
        $this->showModalType = true;
    }

    public function closeModalType()
    {
        $this->resetInputFields();
        $this->showModalType = false;
    }

    public function openModalCharacter()
    {
        $this->edit = false;
        $this->showModalCharacter = true;
    }

    public function closeModalCharacter()
    {
        $this->resetInputFields();
        $this->showModalCharacter = false;
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
        $this->car_brand_list = '';
        $this->car_type_list = '';
        $this->car_character_list = '';
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
                'car_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'car_status' => 'boolean',
                'car_details' => 'nullable|string',
                'car_department' => 'nullable|string',
            ]);

            if ($this->car_photo) {
                if ($this->car_photo instanceof \Illuminate\Http\UploadedFile) {
                    // ดึงชื่อไฟล์และส่วนขยาย
                    $fileName = pathinfo($this->car_photo->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $this->car_photo->getClientOriginalExtension();

                    // ป้องกันชื่อซ้ำ
                    $fileName = $fileName . '_' . time() . '.' . $extension;

                    // บันทึกไฟล์ไปยัง storage/app/public/Image_car
                    $filePath = $this->car_photo->storeAs('Image_car', $fileName, 'public');

                    // เก็บ path เพื่อบันทึกลงฐานข้อมูล
                    $validatedData['car_photo'] = $filePath;
                } else {
                    // กรณีไม่ได้อัปโหลดไฟล์ใหม่ ใช้ path เดิม
                    $validatedData['car_photo'] = $this->car_photo;
                }
            }



            CarReport::create($validatedData);


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

    public function saveBrand()
    {
        try {
            $validatedData = $this->validate([
                'car_brand_list' => 'required|string|max:255',
            ]);


            CarBrand::create($validatedData);

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

    public function saveCarType()
    {
        try {
            $validatedData = $this->validate([
                'car_type_list' => 'required|string|max:255',
            ]);

            CarType::create($validatedData);

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

    public function saveCarCharacter()
    {
        try {
            $validatedData = $this->validate([
                'car_character_list' => 'required|string|max:255',
            ]);

            CarCharacter::create($validatedData);

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
        $this->edit = true;
        $this->showModal = true;
        $this->updateId = $id;
        $carReport = CarReport::findOrFail($id);


        $this->car_number = $carReport->car_number;
        $this->car_county = $carReport->car_county;
        $this->car_type = $carReport->car_type;
        $this->car_character = $carReport->car_character;
        $this->car_brand = $carReport->car_brand;
        $this->car_model = $carReport->car_model;
        $this->car_year = $carReport->car_year;
        $this->car_color = $carReport->car_color;
        $this->car_fuel = $carReport->car_fuel;
        $this->car_mileage = $carReport->car_mileage;
        $this->car_date = $carReport->car_date ? date_format(date_create($carReport->car_date), "Y-m-d") : null;
        $this->car_buy = $carReport->car_buy ? date_format(date_create($carReport->car_buy), "Y-m-d") : null;
        $this->car_tax = $carReport->car_tax ? date_format(date_create( $carReport->car_tax), "Y-m-d") : null;
        $this->car_insurance = $carReport->car_insurance ? date_format(date_create($carReport->car_insurance), "Y-m-d") : null;
        $this->car_photo = $carReport->car_photo;
        $this->car_status = $carReport->car_status;
        $this->car_details = $carReport->car_details;
        $this->car_department = $carReport->car_department;
    }
    public function updateCarReport()
{
    try {
        // ตรวจสอบข้อมูลก่อนบันทึก
        $validatedData = $this->validate([
            'car_number' => 'required|string|max:255',
            'car_county' => 'nullable',
            'car_type' => 'nullable',
            'car_character' => 'nullable',
            'car_brand' => 'nullable',
            'car_model' => 'nullable|string|max:255',
            'car_year' => 'nullable',
            'car_color' => 'nullable|string|max:100',
            'car_fuel' => 'nullable|string|max:100',
            'car_mileage' => 'nullable',
            'car_date' => 'nullable|date',
            'car_buy' => 'nullable|date',
            'car_tax' => 'nullable|date',
            'car_insurance' => 'nullable|date',
            // 'car_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'car_status' => 'boolean',
            'car_details' => 'nullable|string',
            'car_department' => 'nullable',
        ]);

        // ดึงข้อมูลรถจากฐานข้อมูล
        $carReport = CarReport::findOrFail($this->updateId);

        // ตรวจสอบว่ามีการอัปโหลดภาพใหม่หรือไม่
        if ($this->car_photo) {
            if ($this->car_photo instanceof \Illuminate\Http\UploadedFile) {
                // ลบภาพเก่า ถ้ามี
                if ($carReport->car_photo && Storage::disk('public')->exists($carReport->car_photo)) {
                    Storage::disk('public')->delete($carReport->car_photo);
                }

                // ดึงชื่อไฟล์และส่วนขยาย
                $fileName = pathinfo($this->car_photo->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $this->car_photo->getClientOriginalExtension();

                // ป้องกันชื่อซ้ำ
                $fileName = $fileName . '_' . time() . '.' . $extension;

                // บันทึกไฟล์ไปยัง storage/app/public/Image_car
                $filePath = $this->car_photo->storeAs('Image_car', $fileName, 'public');

                // เก็บ path เพื่อบันทึกลงฐานข้อมูล
                $validatedData['car_photo'] = $filePath;
            } else {
                // ใช้ภาพเดิมถ้าไม่มีการอัปโหลดใหม่
                $validatedData['car_photo'] = $carReport->car_photo;
            }
        }
        // อัปเดตข้อมูล
        $carReport->update($validatedData);

        // แจ้งเตือนสำเร็จ
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
        dd($e->errors());
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
        $carReport = CarReport::find($id);

        if ($carReport) {
            $this->dispatch('alertConfirmDelete', [
                'deleteId' => $this->deleteId,
            ]);
        } else {
            session()->flash('error', 'Report Car not found.');
        }
    }
    public function deleteItem()
    {
        $carReport = CarReport::find($this->deleteId);

        if ($carReport) {
            $carReport->delete();

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
