<?php

namespace App\Livewire\MAR;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\WIN\SOInvHD;
use Livewire\WithPagination;
use App\Models\MAR\SalesPlan;
use Illuminate\Support\Facades\DB;

class SaleInvoiceLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $cpoInvoices;
    public $pknInvoices;
    public $salesSummary;
    public $mergedCPO;
    public $mergedPKN;
    public $mergedShell;
    public $mergedEFB;
    public $goodCode;
    public $mergedYearlyCPO;
    public $startDate;
    public $endDate;
    public $monthlySummary;
    public $yearlySummary;
    public $productName;
    public bool $isLoading = false;


    public function mount()
    {
        $this->goodCode = 'S-FG-CPO-0001';
        $this->startDate = '2025-01-01';
        $this->endDate = '2025-12-31';
        $this->loadData();
    }


    public function getMonthlySummaryByGoodCode($goodCode, $startDate, $endDate)
    {
        return SalesPlan::whereHas('emGood', function ($query) use ($goodCode) {
            // กรองให้ `GoodCode` ตรงกับที่ต้องการ
            $query->where('GoodCode', $goodCode);
        })
            ->whereBetween('SOPDate', [$startDate, $endDate]) // เพิ่มเงื่อนไข whereBetween สำหรับ SOPDate
            ->selectRaw("FORMAT(SOPDate, 'yyyy-MM') as month, SUM(NetWei) as total_weight")
            ->groupBy(DB::raw("FORMAT(SOPDate, 'yyyy-MM')"))
            ->orderBy('month', 'asc')
            ->get();
    }
    public function getInvoices($goodCode, $startDate, $endDate, $docuTypes)
    {
        return SOInvHD::with(['details.product', 'details.unit', 'customer'])
            ->whereBetween('DocuDate', [$startDate, $endDate])
            ->whereHas('details', function ($query) use ($docuTypes) { // แก้ไขให้ใช้ use ($docuTypes)
                $query->whereIn('Docutype', $docuTypes);
            })
            ->get()
            ->groupBy(function ($invoice) {
                return Carbon::parse($invoice->DocuDate)->format('Y-m'); // แยกเป็น ปี-เดือน
            })
            ->map(function ($invoices) use ($goodCode) { // เพิ่ม use ($goodCode) เพื่อให้เข้าถึงตัวแปรนี้ได้
                return $invoices->flatMap->details
                    ->where('product.GoodCode', $goodCode) // แก้ไขให้ใช้ตัวแปรที่ถูกต้อง
                    ->groupBy('product.GoodCode')
                    ->map(function ($details, $category) {
                        return [
                            'category' => $category,
                            'quantity' => $details->sum('GoodQty2'),
                            'total_amount' => $details->sum('GoodAmnt'),
                            'avg_price' => $details->sum('GoodAmnt') / max($details->sum('GoodQty2'), 1),
                        ];
                    })
                    ->values();
            });
    }
    public function getMonthlySummaryWithInvoices($goodCode, $startDate, $endDate, $docuTypes)
    {
        // ดึงข้อมูลรายเดือนจาก SalesPlan
        $monthlySummary = $this->getMonthlySummaryByGoodCode($goodCode, $startDate, $endDate);

        // ดึงข้อมูลรายเดือนจาก SOInvHD
        $invoices = $this->getInvoices($goodCode, $startDate, $endDate, $docuTypes);

        // นำข้อมูลจากทั้งสองมาแมปตามเดือน
        $mergedData = $monthlySummary->map(function ($summary) use ($invoices) {
            $month = $summary->month;

            // หาผลรวมของ GoodQty2 ตามเดือน
            $quantity = $invoices->get($month, collect())->sum(function ($invoice) {
                return $invoice['quantity']; // เอาผลรวมจาก GoodQty2
            });
            // คำนวณราคาเฉลี่ย
            $avg_price = $quantity ?  $invoices->get($month, collect())->sum('total_amount') / $summary->total_weight : 0;

            return [
                'month' => $month,
                'total_weight' => $summary->total_weight,
                'quantity' => $quantity,
                'total_amount' => $invoices->get($month, collect())->sum('total_amount'),
                'avg_price' => $avg_price
            ];
        });

        return $mergedData;
    }

    public function getYearlyInvoices($goodCode, $startDate, $endDate, $docuTypes)
    {
        return SOInvHD::with(['details.product', 'details.unit', 'customer'])
            ->whereBetween('DocuDate', [$startDate, $endDate])
            ->whereHas('details', function ($query) use ($docuTypes) {
                $query->whereIn('Docutype', $docuTypes);
            })
            ->get()
            ->flatMap->details
            ->where('product.GoodCode', $goodCode)
            ->groupBy(function ($detail) {
                return Carbon::parse($detail->DocuDate)->format('Y'); // แยกเป็นปี
            })
            ->map(function ($details) {
                return [
                    'total_amount' => $details->sum('GoodAmnt'),
                    'total_quantity' => $details->sum('GoodQty2'),
                    'avg_price' => $details->sum('GoodAmnt') / max($details->sum('GoodQty2'), 1),
                ];
            });
    }
    public function getYearlySummaryByGoodCode($goodCode, $startDate)
    {
        $year = Carbon::parse($startDate)->format('Y');
        return SalesPlan::whereHas('emGood', function ($query) use ($goodCode) {
            // กรองให้ตรงกับ GoodCode ที่ต้องการ
            $query->where('GoodCode', $goodCode);
        })
            ->whereYear('SOPDate', $year)  // กรองตามปีที่ต้องการ
            ->selectRaw("GoodID, SUM(NetWei) as total_weight")  // คำนวณผลรวมของน้ำหนัก
            ->groupBy('GoodID')  // กลุ่มตาม GoodID
            ->orderBy('total_weight', 'desc')  // เรียงตามน้ำหนักรวม
            ->get();  // ดึงข้อมูล
    }

    public function getYearlySummaryWithInvoices($goodCode, $startDate, $endDate, $docuTypes)
    {
        // ดึงข้อมูลรายปีจาก SalesPlan
        $yearlySummary = $this->getYearlySummaryByGoodCode($goodCode, $startDate);

        // ดึงข้อมูลรายปีจาก SOInvHD
        $invoices = $this->getYearlyInvoices($goodCode, $startDate, $endDate, $docuTypes);

        // คำนวณผลรวมทั้งปีจากข้อมูลที่ได้
        $totalWeight = $yearlySummary->sum('total_weight');  // ผลรวมของน้ำหนักทั้งหมดจาก SalesPlan
        $totalQuantity = $invoices->sum('total_quantity');  // ผลรวมของ GoodQty2
        $totalAmount = $invoices->sum('total_amount');  // ผลรวมของยอดขาย
        // คำนวณราคาเฉลี่ย
        $avgPrice = $totalQuantity ? $totalAmount / $totalWeight : 0;

        // ส่งผลรวมทั้งหมดเป็นผลลัพธ์
        return [
            'total_weight' => $totalWeight,
            'quantity' => $totalQuantity,
            'total_amount' => $totalAmount,
            'avg_price' => $avgPrice,
            'yearly_data' => $invoices,  // รวมข้อมูลรายปี
        ];
    }

    private function getProductNameByCode($goodCode)
{
    $product = SalesPlan::whereHas('emGood', function ($query) use ($goodCode) {
        // กรองให้ตรงกับ GoodCode ที่ต้องการ
        $query->where('GoodCode', $goodCode);
    })->first();
    return $product ? $product->GoodName : 'ไม่พบชื่อสินค้า';
}
    public function loadData()
    {
        $this->isLoading = true;
        $this->productName = $this->getProductNameByCode($this->goodCode);
        $this->monthlySummary = $this->getMonthlySummaryWithInvoices($this->goodCode, $this->startDate, $this->endDate,[107, 108]);
        $this->yearlySummary = $this->getYearlySummaryWithInvoices($this->goodCode, $this->startDate, $this->endDate,[107, 108]);
        // sleep(1);
        $this->isLoading = false;
    }

    public function render()
    {

        return view('livewire.mar.sale-invoice-live', [
            'monthlySummary' => $this->monthlySummary,
            'yearlySummary' => $this->yearlySummary,
        ]);
    }
}
