<?php

namespace App\Livewire\RPO;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\RPO\PalmPlan;
use App\Models\WIN\EMVendor;
use Livewire\WithPagination;
use App\Models\WIN\POInvDTCar;
use App\Models\WIN\WebappPOInv;
use App\Models\RPO\SetPriceScaler;

class PalmPurchaseLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
        'refreshComponent' => 'render'
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
    public $sumRamOfDate;
    public $sumAgrOfDate;
    public $countRamOfDate;
    public $progressItem = 0;
    public $progressRam = 0;
    public $progressAgr = 0;
    public $progressFFB = 0;


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
    }
    public function openModalSet()
    {
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
    public function calculateNet()
    {
        $this->GoodNet = max(0, (float) $this->GoodIB - (float) $this->GoodOB);
    }
    public function mount()
    {
        $this->DocuDate = now()->format('Y-m-d');
        $this->selectedDate = now()->format('Y-m-d');
        $this->vendors = EMVendor::orderBy('VendorName', 'asc')->get();
        $setPrices = SetPriceScaler::orderBy('id', 'desc')->first();
        $this->Price1 = optional($setPrices)->set_price;
        $this->Scaler = optional($setPrices)->set_scaler;
    }

    // เมื่อเลือก VendorCode ให้หาชื่อ VendorName อัตโนมัติ
    public function updatedVendorCode()
    {
        $vendor = EMVendor::where('VendorCode', $this->VendorCode)->first();
        $this->VendorName = $vendor ? $vendor->VendorName : null;
    }


    // เมื่อเลือก VendorName ให้หาค่า VendorCode อัตโนมัติ
    public function getVendorName()
    {
        $vendor = EMVendor::where('VendorName', $this->VendorName)->first();
        $this->VendorCode = $vendor ? $vendor->VendorCode : null;
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
        $latestDate = WebappPOInv::max('DocuDate'); // ค้นหาวันที่ล่าสุด
        $webappPOInvs = WebappPOInv::where('DocuDate', $this->selectedDate)
            ->orderBy('POInvID', 'desc')
            ->paginate(10);
        $POInvDTCars = POInvDTCar::limit(10)->get();
        $setPriceScalers = SetPriceScaler::orderBy('id', 'desc')->paginate(5);

        $this->totalPalmOfDate = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->sum('GoodNet');
        $this->totalItemOfDate = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->count('GoodNet');
        $this->sumRamOfDate =  WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->where('VendorCode', 'like', '97%')
            ->sum('GoodNet');
        $this->countRamOfDate = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->whereIn('TypeCarID', ['10Wheels', '6Wheels', 'Trailer'])
            ->count();

        $palmPlan = PalmPlan::whereDate('created_at', $this->selectedDate)->sum('palm_plan') ?? 0;
        $listPlan = PalmPlan::whereDate('created_at', $this->selectedDate)->value('list_plan') ?? 0;

        // dd($this->selectedDate, $this->totalPalmOfDate, $palmPlan);

        $this->sumAgrOfDate = $this->totalPalmOfDate - $this->sumRamOfDate;

        $this->progressFFB = ($palmPlan > 0) ? ($this->totalPalmOfDate / $palmPlan) * 100 : 0;
        $this->progressRam = ($this->totalPalmOfDate > 0) ? ($this->sumRamOfDate / $this->totalPalmOfDate) * 100 : 0;
        $this->progressAgr = ($this->progressRam > 0) ? (100 - $this->progressRam) : 0;;
        $this->progressItem = ($listPlan > 0) ? ($this->countRamOfDate / $listPlan) * 100 : 0;

        return view('livewire.rpo.palm-purchase-live', [
            'webappPOInvs' => $webappPOInvs,
            'POInvDTCars' => $POInvDTCars,
            'setPriceScalers' => $setPriceScalers,
        ]);
    }

    public function resetInputFields()
    {
        $this->POInvID = '';
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
        $validatedData = $this->validate(
            [
                'DocuDate' => 'required',
                'BillID' => 'required',
                'VendorCode' => 'required',
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
        $lastId = WebappPOInv::max('POInvID'); // หาค่าล่าสุด
        $newId = $lastId ? $lastId + 1 : 1;
        $validatedData['POInvID'] = $newId;
        $validatedData['Price1'] = number_format($this->Price1, 2, '.', '');
        $validatedData['GoodNet'] = max(0, (float) $this->GoodIB - (float) $this->GoodOB);
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

        $this->closeModal();
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
        $this->POInvID = $this->webappPOInv->POInvID;
        $this->DocuDate = $this->webappPOInv->DocuDate;
        $this->BillID = $this->webappPOInv->BillID;
        $this->VendorCarID = $this->webappPOInv->VendorCarID;
        $this->TypeCarID = $this->webappPOInv->TypeCarID;
        $this->GoodIB = $this->webappPOInv->GoodIB;
        $this->GoodOB = $this->webappPOInv->GoodOB;
        $this->GoodNet = $this->webappPOInv->GoodNet;
        $this->Price1 = $this->webappPOInv->Price1;
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
                'GoodIB' => 'required|integer|regex:/^\d+$/',
                'GoodOB' => 'required|integer|regex:/^\d+$/',
                'Grade' => 'required',
                'Impurity' => 'required',
                'Scaler' => 'required',
            ]
        );
        $validatedData['Price1'] = number_format($this->Price1, 2, '.', '');
        $validatedData['GoodNet'] = max(0, (float) $this->GoodIB - (float) $this->GoodOB);
        $validatedData['Amnt1'] = max(0, (float) $this->GoodNet * (float) $this->Price1);

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
        $this->dispatch(
            'alertConfirmDelete',
            [
                'deleteId' => $this->deleteId,
            ]
        );
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
