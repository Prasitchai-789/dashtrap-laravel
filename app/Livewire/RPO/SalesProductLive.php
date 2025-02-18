<?php

namespace App\Livewire\RPO;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\WIN\EMCust;
use App\Models\WIN\EMGood;
use App\Models\MAR\SalesPlan;
use App\Http\Controllers\Notify\Telegram;

class SalesProductLive extends Component
{
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
        'statusConfirmed' => 'statusConfirmed',
    ];
    public $edit = false;
    public SalesPlan $salesPlan;
    public $showModal = false;
    public $deleteId;
    public $cancelId;
    public $updateId;
    public $statusID;
    public $SOPID;
    public $SOPDate;
    public $GoodID;
    public $GoodName;
    public $NumberCar;
    public $DriverName;
    public $CustID;
    public $CustName;
    public $Recipient;
    public $AmntLoad;
    public $IBWei;
    public $OBWei;
    public $NetWei;
    public $GoodPrice;
    public $Status;
    public $ReceivedDate;
    public $Remarks;
    public $selectedDate;
    public $drivers = [];
    public $emGoods = [];
    public $carPlates = []; // เก็บรายการทะเบียนรถทั้งหมด
    public $driveNames = [];
    public $recipients = [];
    public $emCusts;
    public $sumOfDateCPO;
    public $sumOfDatePKN;
    public $sumOfDateShell;
    public $sumOfDateEFB;
    public $progressCPO = 0;
    public $progressPKN = 0;
    public $progressShell = 0;
    public $progressEFB = 0;

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
        $this->edit = false;
    }

    public function resetInputFields()
    {
        //
    }

    public function calculateNet()
    {
        $this->NetWei = max(0, (float) $this->OBWei - (float) $this->IBWei);
    }

    public function changeStatus($id)
    {
        $this->statusID = $id;
        $this->dispatch('changeStatus');
    }
    public function statusConfirmed()
    {
        $salesPlan = SalesPlan::find($this->statusID);

        if ($salesPlan) {
            // อัปเดตค่า status เป็น 'P'
            $salesPlan->update(['Status' => 'P']);

            // แสดงแจ้งเตือนสำเร็จ
            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "อัปเดตสถานะสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );
            $message = "โหลดสินค้า: " . $salesPlan->GoodName .
                "\n" . "📆 วันที่: "  . \Carbon\Carbon::parse($salesPlan->SOPDate)->locale('th')->translatedFormat('d F Y') .
                "\n" . "🚘 ทะเบียน: "  . $salesPlan->NumberCar.
                "\n" . "🙎‍♂️ ผู้ขับ: "  . $salesPlan->DriverName;

            $Telegram = new Telegram();
            $Telegram->sendToTelegram($message);

        } else {
            // แสดงแจ้งเตือนเมื่อไม่พบข้อมูล
            $this->dispatch(
                'alert',
                position: "center",
                icon: "error",
                title: "เกิดข้อผิดพลาด ไม่พบข้อมูล",
                showConfirmButton: false,
                timer: 1500
            );
        }
    }

    public function updatedOBWei()
    {
        $this->OBWei = str_replace(',', '', $this->OBWei);
    }

    public function updatedIBWei()
    {
        $this->IBWei = str_replace(',', '', $this->IBWei);
    }

    public function calculateWeight()
    {
        $iBWei = (float) str_replace(',', '', $this->IBWei);
        $oBWei = (float) str_replace(',', '', $this->OBWei);

        // คำนวณน้ำหนักสุทธิ
        $NetWei = $oBWei - $iBWei;

        // ตรวจสอบไม่ให้ NetWei ติดลบ
        return max(0, $NetWei);
    }

    public function mount()
    {
        $this->SOPDate = now()->format('Y-m-d');
        $this->selectedDate = now()->format('Y-m-d');
        $this->carPlates = SalesPlan::select('NumberCar')
            ->whereRaw("NumberCar LIKE '[0-9][0-9]%'") // เลือกเฉพาะที่ขึ้นต้นด้วยเลข 2 ตัว
            ->distinct()
            ->pluck('NumberCar')
            ->toArray();

        $productCodes = [2147, 2151, 2149, 2152, 2150, 2148]; // รหัสสินค้าที่ต้องการดึง
        $this->emGoods = EMGood::whereIn('GoodID', $productCodes)->get();

        $this->driveNames = SalesPlan::select('DriverName')->distinct()->pluck('DriverName')->toArray();
        $this->recipients = SalesPlan::select('Recipient')->distinct()->pluck('Recipient')->toArray();
        $this->emCusts = EMCust::orderBy('CustCode', 'asc')->get();
        $this->SelectedDate();
    }
    public function SelectedDate()
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

        $goodIDs = [2147, 2152, 2151, 2149]; // รายการสินค้าที่ต้องการดึงข้อมูล

        // ดึงข้อมูลผลรวมของ NetWei และจำนวน order ของแต่ละสินค้า
        $sumOfDateData = SalesPlan::whereDate('SOPDate', $this->selectedDate)
            ->whereIn('GoodID', $goodIDs)
            ->groupBy('GoodID')
            ->selectRaw("
        GoodID,
        SUM(NetWei) as totalNetWei,
        COUNT(*) as totalCount,
        SUM(CASE WHEN Status = 'F' THEN 1 ELSE 0 END) as countF,
        SUM(CASE WHEN Status = 'P' THEN 1 ELSE 0 END) as countP,
        SUM(CASE WHEN Status = 'W' THEN 1 ELSE 0 END) as countW
    ")
            ->get()
            ->keyBy('GoodID'); // แปลงเป็น associative array โดยใช้ GoodID เป็น key

        // กำหนดค่าผลรวมให้แต่ละสินค้า
        $this->sumOfDateCPO = $sumOfDateData[2147]->totalNetWei ?? 0;
        $this->sumOfDatePKN = $sumOfDateData[2152]->totalNetWei ?? 0;
        $this->sumOfDateShell = $sumOfDateData[2151]->totalNetWei ?? 0;
        $this->sumOfDateEFB = $sumOfDateData[2149]->totalNetWei ?? 0;

        // คำนวณเปอร์เซ็นต์ความคืบหน้าของแต่ละสินค้า
        $this->progressCPO = ($sumOfDateData[2147]->totalCount ?? 0) > 0
            ? (($sumOfDateData[2147]->totalCount - $sumOfDateData[2147]->countP - $sumOfDateData[2147]->countW) / $sumOfDateData[2147]->totalCount) * 100
            : 0;

        $this->progressPKN = ($sumOfDateData[2152]->totalCount ?? 0) > 0
            ? (($sumOfDateData[2147]->totalCount - $sumOfDateData[2147]->countP - $sumOfDateData[2147]->countW) / $sumOfDateData[2152]->totalCount) * 100
            : 0;

        $this->progressShell = ($sumOfDateData[2151]->totalCount ?? 0) > 0
            ? (($sumOfDateData[2151]->totalCount - $sumOfDateData[2151]->countP - $sumOfDateData[2151]->countW) / $sumOfDateData[2151]->totalCount) * 100
            : 0;

        $this->progressEFB = ($sumOfDateData[2149]->totalCount ?? 0) > 0
            ? (($sumOfDateData[2149]->totalCount - $sumOfDateData[2149]->countP - $sumOfDateData[2149]->countW) / $sumOfDateData[2149]->totalCount) * 100
            : 0;
    }

    public function render()
    {
        $salesPlans = SalesPlan::whereDate('SOPDate', $this->selectedDate)
            ->where('Status', '!=', 'C')
            ->orderBy('SOPID', 'desc')
            ->paginate(10);
        return view('livewire.rpo.sales-product-live', [
            'salesPlans' => $salesPlans,
        ]);
    }

    public function confirmSave($id)
    {
        $this->showModal = true;
        $this->edit = false;
        $this->updateId = $id;
        $this->salesPlan = SalesPlan::find($id);
        if ($this->salesPlan) {
            $this->SOPDate = date_format(date_create($this->salesPlan->BeginWorkDate), "Y-m-d");
        }
        $this->GoodID = $this->salesPlan->GoodID;
        $this->GoodName = $this->salesPlan->GoodName;
        $this->NumberCar = $this->salesPlan->NumberCar;
        $this->DriverName = $this->salesPlan->DriverName;
        $this->CustName = $this->salesPlan->emCust->CustName;
        $this->Recipient = $this->salesPlan->Recipient;
        $this->AmntLoad = number_format($this->salesPlan->AmntLoad, 0, '.', ',') . ' kg.';
        $this->Remarks = $this->salesPlan->Remarks;
    }

    public function confirmEdit($id)
    {
        $this->showModal = true;
        $this->edit = true;
        $this->updateId = $id;
        $this->salesPlan = SalesPlan::find($id);
        if ($this->salesPlan) {
            $this->SOPDate = date_format(date_create($this->salesPlan->BeginWorkDate), "Y-m-d");
        }
        $this->GoodID = $this->salesPlan->GoodID;
        $this->GoodName = $this->salesPlan->GoodName;
        $this->NumberCar = $this->salesPlan->NumberCar;
        $this->DriverName = $this->salesPlan->DriverName;
        $this->CustName = $this->salesPlan->emCust->CustName;
        $this->Recipient = $this->salesPlan->Recipient;
        $this->AmntLoad = number_format($this->salesPlan->AmntLoad, 0, '.', ',');
        $this->OBWei = number_format($this->salesPlan->OBWei, 0, '.', ',');
        $this->IBWei = number_format($this->salesPlan->IBWei, 0, '.', ',');
        $this->NetWei = number_format($this->salesPlan->NetWei, 0, '.', ',');
        $this->Remarks = $this->salesPlan->Remarks;
    }
    public function saveWeight()
    {

        try {
            $validatedData = $this->validate(
                [
                    'OBWei' => 'required|integer|regex:/^\d+$/',
                    'IBWei' => 'required|integer|regex:/^\d+$/',
                    'Remarks' => 'nullable',
                ]
            );

            $validatedData['NetWei'] = $this->calculateWeight();
            $validatedData['Status'] = 'F';

            $salesPlan = SalesPlan::find($this->updateId);

            $salesPlan->update($validatedData);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModal();
            $this->mount();

            $message = "โหลดสินค้า: " . $salesPlan->GoodName .
                "\n" . "📆 วันที่: "  . \Carbon\Carbon::parse($salesPlan->SOPDate)->locale('th')->translatedFormat('d F Y') .
                "\n" . "🚘 ทะเบียน: "  . $salesPlan->NumberCar.
                "\n" . "🛢️ น้ำหนักสุทธิ: "  .  number_format($validatedData['NetWei'], 0, '.', ',')." กิโลกรัม";



            $Telegram = new Telegram();
            $Telegram->sendToTelegram($message);

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

    public function updateWeight()
    {

        try {
            $validatedData = $this->validate(
                [
                    'OBWei' => 'required|integer|regex:/^\d+$/',
                    'IBWei' => 'required|integer|regex:/^\d+$/',
                    'Remarks' => 'nullable',
                ]
            );

            $iBWei = (float) str_replace(',', '', $this->IBWei);
            $oBWei = (float) str_replace(',', '', $this->OBWei);

            $validatedData['OBWei'] = max(0, (float) $oBWei);
            $validatedData['IBWei'] = max(0, (float) $iBWei);
            $validatedData['NetWei'] = max(0, (float) $oBWei - (float) $iBWei);
            $validatedData['Status'] = 'F';

            $salesPlan = SalesPlan::find($this->updateId);
            $salesPlan->update($validatedData);

            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "บันทึกข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1500
            );

            $this->closeModal();
            $this->mount();
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
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $salesPlan = SalesPlan::find($id);

        if ($salesPlan) {
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
        $salesPlan = SalesPlan::find($this->deleteId);
        if ($salesPlan) {
            $salesPlan->delete();
            $this->dispatch(
                'alert',
                position: "center",
                icon: "success",
                title: "ลบข้อมูลสำเร็จ",
                showConfirmButton: false,
                timer: 1600
            );
            $this->mount();
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
