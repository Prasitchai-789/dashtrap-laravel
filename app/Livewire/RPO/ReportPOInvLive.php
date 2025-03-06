<?php

namespace App\Livewire\RPO;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\WIN\POInvHD;
use App\Models\RPO\PalmPlan;
use App\Models\WIN\EMVendor;
use Livewire\WithPagination;
use App\Models\WIN\POInvDTCar;
use App\Models\WIN\WebappPOInv;
use App\Models\RPO\SetPriceScaler;

class ReportPOInvLive extends Component
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
    public $totalPalmOfAmnt2;
    public $totalAmnt2OfDate;
    public $totalItemOfDate;
    public $sumRamOfDate;
    public $sumAgrOfDate;
    public $AvgPrice;
    public $countRamOfDate;
    public $totalPalmOfMonth;
    public $totalAmnt2OfMonth;
    public $avgPriceOfMonth;
    public $progressItem = 0;
    public $progressRam = 0;
    public $progressAgr = 0;
    public $progressFFB = 0;
    public $vendorCarID;
    public $sumVendor;
    public $avgPrice2;
    public $progressMaxPrice2;
    public $progressAvg;

    public $selectedMonth; // เดือนที่เลือก
    public $selectedYear; // เดือนที่เลือก
    public $monthNumber; // ตัวเลขเดือน
    public $categoriesGD = []; // ข้อมูลวัน
    public $dataSeriesGD = []; // ข้อมูลผลรวม GoodNet

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


    public function mount()
    {
        $this->DocuDate = now()->subDays()->format('Y-m-d');
        $this->selectedDate = now()->subDays()->format('Y-m-d');
        $now = Carbon::now();
        $this->selectedYear = $now->year;   // ค่าเริ่มต้นเป็นปีปัจจุบัน
        $this->selectedMonth = $now->month;
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
    }
    public function render()
    {
        Carbon::setLocale('th');
        $latestDate = POInvHD::max('DocuDate'); //

        $POInvQuery = POInvHD::whereDate('DocuDate', $this->selectedDate);

        // ดึงข้อมูล POInvHD ที่เกี่ยวข้องเพียงครั้งเดียว
        $poData = POInvHD::whereDate('DocuDate', $this->selectedDate)
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->get();

        if ($poData->isEmpty()) {
            // หากไม่มีข้อมูลที่ตรงกับเงื่อนไข
            dd('No data found');
        }
        // รวมข้อมูล poDT ทั้งหมดจาก POInvHD
        $poDetails = $poData->flatMap(fn($item) => $item->poDT);

        if ($poDetails->isEmpty()) {
            // หากไม่มีข้อมูล poDT ที่ตรงกับเงื่อนไข
            dd('No poDT data found');
        }
        // คำนวณค่าที่ต้องการ
        $this->totalPalmOfDate = $poDetails->sum('GoodStockQty');
        $this->totalAmnt2OfDate = $poDetails->sum('GoodAmnt') / 1000000;
        $this->totalItemOfDate = $poDetails->count();

        // คำนวณเฉพาะข้อมูลที่ VendorGroupID = 1001
        $this->sumRamOfDate = $poData->filter(fn($item) => $item->vendor?->VendorGroupID == '1001')
            ->flatMap(fn($item) => $item->poDT)
            ->sum('GoodStockQty');

        // คำนวณจำนวนรถ
        $this->countRamOfDate = WebappPOInv::whereDate('DocuDate', $this->selectedDate)
            ->whereIn('TypeCarID', ['10Wheels', '6Wheels', 'Trailer'])
            ->count();

        // คำนวณราคาเฉลี่ย
        $this->AvgPrice = ($this->totalPalmOfDate > 0)
            ? (($this->totalAmnt2OfDate * 1000000) / $this->totalPalmOfDate)
            : 0;


        $poData = POInvHD::whereDate('DocuDate', Carbon::parse($this->selectedDate)->format('Y-m-d'))
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->orderBy('DocuDate', 'desc') // เรียงลำดับตามวันที่จาก POInvHD
            ->get();
        // รวมข้อมูล poDT
        $poDetails = $poData->flatMap(fn($item) => $item->poDT);

        // คำนวณ totalPalmOfDate และ totalAmnt2OfDate
        $totalPalmOfDate = $poDetails->sum('GoodStockQty');
        $totalAmnt2OfDate = $poDetails->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $avgPrice = ($totalPalmOfDate > 0)
            ? (($totalAmnt2OfDate * 1000000) / $totalPalmOfDate)
            : 0;

        $poData1 = POInvHD::whereDate('DocuDate', Carbon::parse($this->selectedDate)->subDays()->format('Y-m-d'))
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->orderBy('DocuDate', 'desc') // เรียงลำดับตามวันที่จาก POInvHD
            ->get();
        // รวมข้อมูล poDT
        $poDetails1 = $poData1->flatMap(fn($item) => $item->poDT);

        // คำนวณ totalPalmOfDate และ totalAmnt2OfDate
        $totalPalmOfDate1 = $poDetails1->sum('GoodStockQty');
        $totalAmnt2OfDate1 = $poDetails1->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $avgPrice1 = ($totalPalmOfDate1 > 0)
            ? (($totalAmnt2OfDate1 * 1000000) / $totalPalmOfDate1)
            : 0;

        $poData2 = POInvHD::whereDate('DocuDate', Carbon::parse($this->selectedDate)->subDays(2)->format('Y-m-d'))
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->orderBy('DocuDate', 'desc') // เรียงลำดับตามวันที่จาก POInvHD
            ->get();
        // รวมข้อมูล poDT
        $poDetails2 = $poData2->flatMap(fn($item) => $item->poDT);

        // คำนวณ totalPalmOfDate และ totalAmnt2OfDate
        $totalPalmOfDate2 = $poDetails2->sum('GoodStockQty');
        $totalAmnt2OfDate2 = $poDetails2->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $avgPrice2 = ($totalPalmOfDate2 > 0)
            ? (($totalAmnt2OfDate2 * 1000000) / $totalPalmOfDate2)
            : 0;

        // คำนวณค่าเฉลี่ย
        $avgPrice1 = ($totalPalmOfDate1 > 0)
            ? (($totalAmnt2OfDate1 * 1000000) / $totalPalmOfDate1)
            : 0;

        $poData3 = POInvHD::whereDate('DocuDate', Carbon::parse($this->selectedDate)->subDays(3)->format('Y-m-d'))
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->orderBy('DocuDate', 'desc') // เรียงลำดับตามวันที่จาก POInvHD
            ->get();
        // รวมข้อมูล poDT
        $poDetails3 = $poData3->flatMap(fn($item) => $item->poDT);

        // คำนวณ totalPalmOfDate และ totalAmnt2OfDate
        $totalPalmOfDate3 = $poDetails3->sum('GoodStockQty');
        $totalAmnt2OfDate3 = $poDetails3->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $avgPrice3 = ($totalPalmOfDate3 > 0)
            ? (($totalAmnt2OfDate3 * 1000000) / $totalPalmOfDate3)
            : 0;

        $poData4 = POInvHD::whereDate('DocuDate', Carbon::parse($this->selectedDate)->subDays(4)->format('Y-m-d'))
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->orderBy('DocuDate', 'desc') // เรียงลำดับตามวันที่จาก POInvHD
            ->get();
        // รวมข้อมูล poDT
        $poDetails4 = $poData4->flatMap(fn($item) => $item->poDT);

        // คำนวณ totalPalmOfDate และ totalAmnt2OfDate
        $totalPalmOfDate4 = $poDetails4->sum('GoodStockQty');
        $totalAmnt2OfDate4 = $poDetails4->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $avgPrice4 = ($totalPalmOfDate4 > 0)
            ? (($totalAmnt2OfDate4 * 1000000) / $totalPalmOfDate4)
            : 0;

        $poData5 = POInvHD::whereDate('DocuDate', Carbon::parse($this->selectedDate)->subDays(5)->format('Y-m-d'))
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->orderBy('DocuDate', 'desc') // เรียงลำดับตามวันที่จาก POInvHD
            ->get();
        // รวมข้อมูล poDT
        $poDetails5 = $poData5->flatMap(fn($item) => $item->poDT);

        // คำนวณ totalPalmOfDate และ totalAmnt2OfDate
        $totalPalmOfDate5 = $poDetails5->sum('GoodStockQty');
        $totalAmnt2OfDate5 = $poDetails5->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $avgPrice5 = ($totalPalmOfDate5 > 0)
            ? (($totalAmnt2OfDate5 * 1000000) / $totalPalmOfDate5)
            : 0;

        $poData6 = POInvHD::whereDate('DocuDate', Carbon::parse($this->selectedDate)->subDays(6)->format('Y-m-d'))
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->orderBy('DocuDate', 'desc') // เรียงลำดับตามวันที่จาก POInvHD
            ->get();
        // รวมข้อมูล poDT
        $poDetails6 = $poData6->flatMap(fn($item) => $item->poDT);

        // คำนวณ totalPalmOfDate และ totalAmnt2OfDate
        $totalPalmOfDate6 = $poDetails6->sum('GoodStockQty');
        $totalAmnt2OfDate6 = $poDetails6->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $avgPrice6 = ($totalPalmOfDate6 > 0)
            ? (($totalAmnt2OfDate6 * 1000000) / $totalPalmOfDate6)
            : 0;

        // คำนวณค่าเฉลี่ยย้อนหลัง 7 วัน
        $dates = [
            $poData6[0]->DocuDate,
            $poData5[0]->DocuDate,
            $poData4[0]->DocuDate,
            $poData3[0]->DocuDate,
            $poData2[0]->DocuDate,
            $poData1[0]->DocuDate,
            $poData[0]->DocuDate
        ];
        $avgPrices = [
            $avgPrice6,
            $avgPrice5,
            $avgPrice4,
            $avgPrice3,
            $avgPrice2,
            $avgPrice1,
            $avgPrice
        ];
        $formattedDates = collect($dates)->map(function ($date) {
            return Carbon::parse($date)->format('d-m');
        });

        $selectedDate = Carbon::parse($this->selectedDate); // แปลง selectedDate เป็น Carbon
        $startOfMonth = $selectedDate->copy()->startOfMonth(); // วันที่ 1 ของเดือน
        $endOfSelectedDate = $selectedDate->copy(); // วันที่ selectedDate

        $poDataM = POInvHD::whereBetween('DocuDate', [$startOfMonth, $endOfSelectedDate])
            ->with(['poDT' => function ($query) {
                $query->where('GoodID', 2156); // กรองข้อมูลจาก poDT ที่มี GoodID = 2156
            }, 'vendor'])
            ->get();

        // รวมข้อมูล poDT
        $poDetailsM = $poDataM->flatMap(fn($item) => $item->poDT);

        // คำนวณผลรวมตั้งแต่ต้นเดือนถึง selectedDate
        $this->totalPalmOfMonth = $poDetailsM->sum('GoodStockQty');
        $this->totalAmnt2OfMonth = $poDetailsM->sum('GoodAmnt') / 1000000;

        // คำนวณค่าเฉลี่ย
        $this->avgPriceOfMonth = ($this->totalPalmOfMonth > 0)
            ? (($this->totalAmnt2OfMonth * 1000000) / $this->totalPalmOfMonth)
            : 0;

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


        // โหลดค่าแผนการผลิต
        $palmPlanData = PalmPlan::whereDate('created_at', $this->selectedDate)->first();
        $palmPlan = (int) ($palmPlanData->palm_plan ?? 0);
        $listPlan = (int) ($palmPlanData->list_plan ?? 0);
        $maxPrice2 = WebappPOInv::max('Price2');
        $this->avgPrice2 = WebappPOInv::average('Price2');

        // คำนวณผลลัพธ์
        $this->sumAgrOfDate = $this->totalPalmOfDate - $this->sumRamOfDate;
        $this->progressFFB = ($palmPlan > 0) ? ($this->totalPalmOfDate / $palmPlan) * 100 : 0;
        $this->progressMaxPrice2 = ($this->AvgPrice > 0) ? ($this->AvgPrice / $avgPrice1) * 100 : 0;
        $this->progressAvg = ($this->progressMaxPrice2 > 0) ? (100 - $this->progressMaxPrice2) : 0;
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

        $dailyGoodNet = WebappPOInv::selectRaw('
            YEAR(DocuDate) as year,
            MONTH(DocuDate) as month,
            DAY(DocuDate) as day,
            SUM(GoodNet) as total_goodnet
        ')
            ->whereYear('DocuDate', $this->selectedYear) // กรองปีที่เลือก
            ->whereMonth('DocuDate', $this->selectedMonth) // กรองเดือนที่เลือก
            ->groupByRaw('YEAR(DocuDate), MONTH(DocuDate), DAY(DocuDate)')
            ->orderByRaw('YEAR(DocuDate) ASC, MONTH(DocuDate) ASC, DAY(DocuDate) ASC')
            ->get();
        // อัปเดตข้อมูลสำหรับกราฟ
        $this->categoriesGD = $dailyGoodNet->pluck('day')->toArray();
        $this->dataSeriesGD = $dailyGoodNet->pluck('total_goodnet')->toArray();

        return view('livewire.rpo.report-POInv-live', [
            'webappPOInvs' => $webappPOInvs,
            'POInvDTCars' => $POInvDTCars,
            'setPriceScalers' => $setPriceScalers,
            'vendorCarIDs' => $vendorCarIDs,
            'sumVendors' => $sumVendors,
            'formattedDates' => $formattedDates,
            'avgPrices' => $avgPrices,
        ]);
    }
}
