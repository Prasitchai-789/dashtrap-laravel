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

class ReportPalmPurchaseLive extends Component
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
    public $totalAmnt2OfDate;
    public $totalItemOfDate;
    public $sumRamOfDate;
    public $sumAgrOfDate;
    public $AvgPrice;
    public $countRamOfDate;
    public $progressItem = 0;
    public $progressRam = 0;
    public $progressAgr = 0;
    public $progressFFB = 0;
    public $vendorCarID;
    public $sumVendor;

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
        Carbon::setLocale('th');
        $latestDate = WebappPOInv::max('DocuDate'); // ค้นหาวันที่ล่าสุด
        // โหลดข้อมูลที่ใช้ซ้ำหลายครั้ง
        $webappPOInvQuery = WebappPOInv::whereDate('DocuDate', $this->selectedDate);

        // ดึงค่าต่างๆ มาก่อน เพื่อไม่ต้อง query ซ้ำ
        $this->totalPalmOfDate = $webappPOInvQuery->sum('GoodNet');
        $this->totalAmnt2OfDate = $webappPOInvQuery->sum('Amnt2')/1000000;
        $this->totalItemOfDate = $webappPOInvQuery->count();

        // ดึงข้อมูลเฉพาะที่ต้องใช้เงื่อนไขใหม่
        $this->sumRamOfDate = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->where('VendorCode', 'like', '97%')
            ->sum('GoodNet');

        $this->countRamOfDate = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->whereIn('TypeCarID', ['10Wheels', '6Wheels', 'Trailer'])
            ->count();

        // ใช้ค่าที่โหลดมาแล้ว เพื่อป้องกัน Query ซ้ำ
        $this->AvgPrice = ($this->totalPalmOfDate > 0) ? (($this->totalAmnt2OfDate*1000000) / $this->totalPalmOfDate) : 0;

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
            ->paginate(10);
        $this->vendors = EMVendor::select('VendorCode', 'VendorName')
            ->orderBy('VendorName', 'asc')
            ->distinct() // ป้องกันค่าซ้ำ
            ->get();

        $POInvDTCars = POInvDTCar::limit(10)->get();
        $setPriceScalers = SetPriceScaler::orderBy('id', 'desc')->paginate(5);
        $vendorCarIDs = WebappPOInv::distinct()->pluck('VendorCarID');

        $sumVendors = WebappPOInv::selectRaw('VendorCode, SUM(GoodNet) as totalGoodNet, AVG(Price2) as avgPrice')
            ->whereDate('DocuDate', $this->selectedDate)
            ->groupBy('VendorCode')
            ->orderByDesc('totalGoodNet') // เรียงจาก GoodNet มากไปน้อย
            ->limit(10)
            ->get();

        return view('livewire.rpo.report-palm-purchase-live', [
            'webappPOInvs' => $webappPOInvs,
            'POInvDTCars' => $POInvDTCars,
            'setPriceScalers' => $setPriceScalers,
            'vendorCarIDs' => $vendorCarIDs,
            'sumVendors' => $sumVendors,
        ]);
    }
}
