<?php

namespace App\Livewire\ACC;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\RPO\PalmPlan;
use App\Models\WIN\EMVendor;
use Livewire\WithPagination;
use App\Models\WIN\POInvDTCar;
use App\Models\WIN\WebappPOInv;
use App\Models\RPO\SetPriceScaler;

class PurchasePriceLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
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
    public $vendorCarID;

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
   
    public function calculatePrice()
    {
        $this->Amnt2 = max(0, (float) $this->GoodNet * (float) $this->Price2);
        return $this->Amnt2;
    }
    public function mount()
    {
        $this->DocuDate = now()->format('Y-m-d');
        $this->selectedDate = now()->format('Y-m-d');
        $this->vendors = EMVendor::select('VendorCode', 'VendorName')
            ->orderBy('VendorName', 'asc')
            ->distinct() // ป้องกันค่าซ้ำ
            ->get();
        
        $this->setDate();
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
    
        // โหลดข้อมูลที่ใช้ซ้ำหลายครั้ง
        $webappPOInvQuery = WebappPOInv::whereDate('DocuDate', $this->selectedDate);
    
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
    }
    
    public function render()
    {
        $latestDate = WebappPOInv::max('DocuDate'); // ค้นหาวันที่ล่าสุด
    
        // โหลดข้อมูลที่จำเป็น
        $webappPOInvs = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->orderBy('POInvID', 'desc')
            ->paginate(10);
    
        $POInvDTCars = POInvDTCar::limit(10)->get();
        $setPriceScalers = SetPriceScaler::orderBy('id', 'desc')->paginate(5);
        $vendorCarIDs = WebappPOInv::distinct()->pluck('VendorCarID');
        return view('livewire.acc.purchase-price-live', [
            'webappPOInvs' => $webappPOInvs,
            'POInvDTCars' => $POInvDTCars,
            'setPriceScalers' => $setPriceScalers,
            'vendorCarIDs' => $vendorCarIDs,
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
        $this->Amnt2 = '';
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
        $this->Price2 = $this->webappPOInv->Price2;
        $this->Amnt2 = $this->webappPOInv->Amnt2;
        if ($this->webappPOInv) {
            $this->VendorCode = $this->webappPOInv->VendorCode;
            $this->VendorName = optional($this->webappPOInv->empVendor)->VendorName;
        }
        $this->Grade = $this->webappPOInv->Grade;
        $this->Impurity = $this->webappPOInv->Impurity;
        $this->DocuType = $this->webappPOInv->DocuType;
    }

    public function updatePurchasePrice()
    {
        $this->Price2 = str_replace(',', '', $this->Price2);

        try {
            $validatedData = $this->validate(
                [
                    'Price2' => 'required|numeric|min:0',
                    'DocuType' => 'required',
                ]
            );
            $webappPOInv = WebappPOInv::find($this->updateId);
            $validatedData['Amnt2'] = max(0, (float) $this->GoodNet * (float) $this->Price2);
            
            if ($webappPOInv) {
                $webappPOInv->update($validatedData);
            } else {
                // สร้างใหม่ถ้าไม่มีข้อมูล
                WebappPOInv::create($validatedData);
            }
    
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
        catch (\Illuminate\Validation\ValidationException $e) {

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
