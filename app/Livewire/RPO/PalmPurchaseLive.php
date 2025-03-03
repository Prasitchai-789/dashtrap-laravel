<?php

namespace App\Livewire\RPO;

use DateTime;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\RPO\PalmPlan;
use App\Models\WIN\EMVendor;
use Livewire\WithPagination;
use App\Models\WIN\POInvDTCar;
use App\Models\WIN\WebappPOInv;
use App\Models\RPO\SetPriceScaler;
use App\Http\Controllers\Notify\Telegram;

class PalmPurchaseLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
        'refreshComponent' => 'render',
        'openModalSet' => 'openModalSet',
    ];
    public $edit = false;
    public WebappPOInv $webappPOInv;
    public SetPriceScaler $setPriceScaler;
    public $showModal = false;
    public $showModalSet = false;
    public $showModalTableSet = false;
    public $deleteId;
    public $updateId;

    public
        $POInvID,
        $DocuDate,
        $BillID,
        $VendorCarID,
        $TypeCarID,
        $GoodIB,
        $GoodOB,
        $GoodNet,
        $Price1,
        $Amnt1,
        $Price2,
        $Amnt2,
        $VendorCode,
        $VendorName,
        $StatusBill,
        $Grade,
        $Impurity,
        $Scaler,
        $DocuType;
    public $vendors;
    public $set_price;
    public $set_scaler;
    public $selectedDate;
    public $totalPalmOfDate;
    public $totalItemOfDate;
    public $ItemOfDate;
    public $sumRamOfDate;
    public $sumAgrOfDate;
    public $countRamOfDate;
    public $progressItem = 0;
    public $progressRam = 0;
    public $progressAgr = 0;
    public $progressFFB = 0;
    public $vendorCarID;
    public $firstTypeCarID;
    public $vendorCarList = [];


    public bool $isLoading = false;

    public function initLoading()
    {
        $this->isLoading = true;
    }
    public function openModal()
    {
        $this->showModal = true;
        $this->mount();
    }
    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModal = false;
        $this->edit = false;
    }
    public function openModalSet()
    {
        $this->closeModal();
        $this->showModalSet = true;
        $this->edit = false;
    }

    public function closeModalSet()
    {
        $this->resetInputFields();
        $this->showModalSet = false;
    }
    public function openModalTableSet()
    {
        $this->showModalTableSet = true;
    }

    public function closeModalTableSet()
    {
        $this->showModalTableSet = false;
    }
    public function addEmployee()
    {
        $this->edit = false;
    }

    // ฟังก์ชันอัปเดตค่าและลบคอมม่า
    public function updatedGoodOB()
    {
        $this->GoodOB = str_replace(',', '', $this->GoodOB);
    }

    public function updatedGoodIB()
    {
        $this->GoodIB = str_replace(',', '', $this->GoodIB);
    }

    public function calculateWeight()
    {
        $goodIB = (float) str_replace(',', '', $this->GoodIB);
        $goodOB = (float) str_replace(',', '', $this->GoodOB);

        return $goodIB - $goodOB;
    }

    public function mount()
    {
        $this->DocuDate = now()->format('Y-m-d');
        $this->selectedDate = now()->format('Y-m-d');

        $setPrices = SetPriceScaler::whereDate('created_at', $this->selectedDate)->first();
        if (!$setPrices) {
            $this->dispatch('showSweetAlert');
        } else {
            $this->Price1 = number_format($setPrices->set_price, 2);
            $this->Scaler = $setPrices->set_scaler;
        }
        $this->setDate();
    }


    public function getVendorName()
    {
        $vendor = EMVendor::where('VendorCode', $this->VendorCode)->first();
        $this->VendorName = $vendor ? $vendor->VendorName : null;
        $this->updatedVendorCode();
    }
    public function updatedVendorCode()
    {
        $this->vendorCarList = WebappPOInv::where('VendorCode', $this->VendorCode)
            ->distinct()
            ->pluck('VendorCarID')
            ->toArray();

        // ล้างค่าทะเบียนรถและประเภทรถเมื่อเปลี่ยนรหัสลูกค้า
        $this->VendorCarID = null;
        $this->TypeCarID = null;
    }

    public function getVendorCarName()
    {
        $typeCarID = WebappPOInv::where('VendorCarID',$this->VendorCarID)->first();
        $this->TypeCarID = $typeCarID ? $typeCarID->TypeCarID : null;
    }
    public function setDate()
    {
        if (Carbon::parse($this->selectedDate)->greaterThan(Carbon::today())) {
            $this->selectedDate = Carbon::today()->toDateString(); // รีเซ็ตเป็นวันนี้
            $this->dispatch(
                'alertDate',
                position: "center",
                icon: "error",
                title: "ไม่พบข้อมูล",
                text: "ไม่สามารถเลือกวันที่มากกว่าวันปัจจุบันได้ !",
                showConfirmButton: false,
                timer: 2500
            );
        }
    }

    public function render()
    {
        // Carbon::setLocale('th');
        $latestDate = WebappPOInv::max('DocuDate'); // ค้นหาวันที่ล่าสุด
        // โหลดข้อมูลที่ใช้ซ้ำหลายครั้ง
        $webappPOInvQuery = WebappPOInv::whereDate('DocuDate', $this->selectedDate);

        $this->ItemOfDate = (clone $webappPOInvQuery)->whereNull('Amnt2')->count();

        // คำนวณค่าต่าง ๆ และเก็บเป็น property เพื่อลดการประมวลผลซ้ำ
        $this->totalPalmOfDate = $webappPOInvQuery->sum('GoodNet');
        $this->totalItemOfDate = $webappPOInvQuery->count();
        $this->sumRamOfDate = $webappPOInvQuery->where('VendorCode', 'like', '97%')->sum('GoodNet');
        $this->countRamOfDate = $webappPOInvQuery->whereIn('TypeCarID', ['10Wheels', '6Wheels', 'Trailer'])->count();
        // โหลดค่าแผนการผลิต
        $palmPlanData = PalmPlan::whereDate('created_at', $this->selectedDate)->first();
        $palmPlan = (int) ($palmPlanData->palm_plan ?? 0);
        $listPlan = (int) ($palmPlanData->list_plan ?? 0);

        // คำนวณผลลัพธ์
        $this->sumAgrOfDate = $this->totalPalmOfDate - $this->sumRamOfDate;
        $this->progressFFB = ($palmPlan > 0) ? ($this->totalPalmOfDate / $palmPlan) * 100 : 0;
        $this->progressRam = ($this->totalPalmOfDate > 0) ? ($this->sumRamOfDate / $this->totalPalmOfDate) * 100 : 0;
        $this->progressAgr = ($this->progressRam > 0) ? (100 - $this->progressRam) : 0;
        $this->progressItem = ($listPlan > 0) ? ($this->countRamOfDate / $listPlan) * 100 : 0;

        // โหลดข้อมูลที่จำเป็น
        $webappPOInvs = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->orderBy('POInvID', 'desc')
            ->paginate(50);
        $this->vendors = EMVendor::select('VendorCode', 'VendorName')
            ->orderBy('VendorName', 'asc')
            ->distinct() // ป้องกันค่าซ้ำ
            ->get();

        $vendorCarIDs = WebappPOInv::distinct()->pluck('VendorCarID');
        $POInvDTCars = POInvDTCar::limit(10)->get();
        $setPriceScalers = SetPriceScaler::orderBy('id', 'desc')->paginate(5);


        return view('livewire.rpo.palm-purchase-live', [
            'webappPOInvs' => $webappPOInvs,
            'POInvDTCars' => $POInvDTCars,
            'setPriceScalers' => $setPriceScalers,
            'vendorCarIDs' => $vendorCarIDs,

        ]);
    }


    public function resetInputFields()
    {
        // $this->POInvID = '';
        $this->DocuDate = '';
        $this->BillID = '';
        $this->VendorCarID = '';
        $this->TypeCarID = '';
        $this->GoodIB = '';
        $this->GoodOB = '';
        $this->GoodNet = '';
        $this->Price1 = '';
        $this->Amnt1 = '';
        $this->Price2 = '';
        $this->Amnt2 = '';
        $this->VendorCode = '';
        $this->VendorName = '';
        $this->StatusBill = '';
        $this->Grade = '';
        $this->Impurity = '';
        $this->Scaler = '';
        $this->DocuType = '';
        $this->set_price = '';
        $this->set_scaler = '';
    }

    public function savePalmPurchase()
    {
        try {
            $validatedData = $this->validate(
                [
                    'DocuDate' => 'required',
                    'BillID' => 'required',
                    'VendorName' => 'required',
                    'VendorCarID' => 'required',
                    'TypeCarID' => 'required',
                    'GoodIB' => 'required|integer|regex:/^\d+$/',
                    'GoodOB' => 'required|integer|regex:/^\d+$/',
                    'Price1' => 'required',
                    'Grade' => 'required',
                    'Impurity' => 'required',
                    'Scaler' => 'required',
                ]
            );
            $validatedData['VendorCode'] = $this->VendorCode;

            $validatedData['Price1'] = number_format($this->Price1, 2, '.', '');
            $validatedData['GoodNet'] = $this->calculateWeight();
            $validatedData['Amnt1'] = max(0, (float) $this->GoodNet * (float) $this->Price1);

            webappPOInv::create($validatedData);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );
            $countPOInvs = WebappPOInv::whereDate('DocuDate', $this->selectedDate)->count();

            // ลำดับที่เพิ่มเข้ามาใหม่
            $newOrder = $countPOInvs++;

            $sumPalm = $this->totalPalmOfDate + max(0, (float) $this->calculateWeight());
            $message = "FFB : " . number_format($sumPalm, 0, '.', ',') . " kg." .
                "\n" . "📆 วันที่: "  . \Carbon\Carbon::parse($this->DocuDate)->locale('th')->translatedFormat('d F Y') .
                "\n" . "✅ รายการที่: "  . $newOrder .
                "\n" . "📋 เลขที่เอกสาร: "  . $this->BillID .
                "\n" . "🙎‍♂️ ลูกค้า: "  . $this->VendorName .
                "\n" . "🛒 น้ำหนักสุทธิ = "  . number_format($this->calculateWeight(), 0, '.', ',') . " kg." .
                "\n" . "🌴 น้ำหนักรวมทั้งหมด= "  . number_format($sumPalm, 0, '.', ',') . " kg.";

            $Telegram = new Telegram();
            $Telegram->sendToTelegramFFB($message);
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
    protected $messages = [
        'GoodOB.integer' => 'กรุณากรอกตัวเลขจำนวนเต็มเท่านั้น',
        'GoodIB.integer' => 'กรุณากรอกตัวเลขจำนวนเต็มเท่านั้น',
    ];
    public function confirmEdit($id)
    {
        $this->showModal = true;
        $this->edit = true;
        $this->updateId = $id;
        $this->webappPOInv = WebappPOInv::find($id);
        // $this->POInvID = $this->webappPOInv->POInvID;
        $this->DocuDate = $this->webappPOInv->DocuDate;
        $this->BillID = $this->webappPOInv->BillID;
        $this->VendorCarID = $this->webappPOInv->VendorCarID;
        $this->TypeCarID = $this->webappPOInv->TypeCarID;
        $this->GoodIB = number_format($this->webappPOInv->GoodIB, 0);
        $this->GoodOB = number_format($this->webappPOInv->GoodOB, 0);
        $this->GoodNet = number_format($this->webappPOInv->GoodNet, 0);
        $this->Price1 = number_format($this->webappPOInv->Price1, 2);
        if ($this->webappPOInv) {
            $this->VendorCode = $this->webappPOInv->VendorCode;
            $this->VendorName = optional($this->webappPOInv->empVendor)->VendorName;
        }
        $this->Grade = $this->webappPOInv->Grade;
        $this->Impurity = $this->webappPOInv->Impurity;
        $this->Scaler = $this->webappPOInv->Scaler;
    }
    public function updatePalmPurchase()
    {
        $validatedData = $this->validate(
            [
                'DocuDate' => 'required',
                'BillID' => 'required',
                'VendorCode' => 'required',
                'VendorName' => 'required',
                'VendorCarID' => 'required',
                'TypeCarID' => 'required',
                'Grade' => 'required',
                'Impurity' => 'required',
                'Scaler' => 'required',
            ]
        );

        $goodIB = str_replace(',', '', $this->GoodIB);
        $goodOB = str_replace(',', '', $this->GoodOB);
        $goodNet = str_replace(',', '', $this->GoodNet);
        $price1 = str_replace(',', '', $this->Price1);

        $validatedData['GoodIB'] = max(0, (float) $goodIB);
        $validatedData['GoodOB'] = max(0, (float) $goodOB);
        $validatedData['Price1'] = number_format($this->Price1, 2, '.', '');
        $validatedData['GoodNet'] = $this->calculateWeight();
        $validatedData['Amnt1'] = max(0, (float) $goodNet * (float) $price1);

        $this->webappPOInv->update($validatedData);

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
        $webappPOInv = WebappPOInv::find($id);
        if ($webappPOInv) {
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
        $webappPOInv = WebappPOInv::find($this->deleteId);
        if ($webappPOInv) {
            $webappPOInv->delete();
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

    public function saveSetPrice()
    {
        $validatedData = $this->validate(
            [
                'set_price' => 'required|numeric|min:0|max:1000000',
                'set_scaler' => 'required',
            ]
        );
        $validatedData['set_price'] = max(0, (float) $this->set_price);
        setPriceScaler::create($validatedData);
        $this->dispatch(
            'alert',
            position: "center",
            icon: "success",
            title: "บันทึกข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        );
        $this->closeModalSet();
    }
    public function confirmEditSetPrice($id)
    {
        $this->showModalSet = true;
        $this->edit = true;
        $this->updateId = $id;
        $setPriceScaler = SetPriceScaler::find($id);
        $this->set_price = $setPriceScaler->set_price;
        $this->set_scaler = $setPriceScaler->set_scaler;
        $this->closeModalTableSet();
    }
    public function updateSetPrice()
    {
        $validatedData = $this->validate(
            [
                'set_price' => 'required|numeric|min:0|max:1000000',
                'set_scaler' => 'required',
            ]
        );
        $setPriceScaler = SetPriceScaler::find($this->updateId);
        $validatedData['set_price'] = max(0, (float) $this->set_price);

        if ($setPriceScaler) {
            $setPriceScaler->update($validatedData);
        } else {
            // สร้างใหม่ถ้าไม่มีข้อมูล
            SetPriceScaler::create($validatedData);
        }

        $this->dispatch(
            'alert',
            position: "center",
            icon: "success",
            title: "แก้ไขข้อมูลสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        );

        $this->closeModalSet();
    }
}
