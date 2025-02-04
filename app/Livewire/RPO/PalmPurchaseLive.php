<?php

namespace App\Livewire\RPO;

use Livewire\Component;
use App\Models\WIN\EMVendor;
use Livewire\WithPagination;
use App\Models\WIN\POInvDTCar;
use App\Models\WIN\WebappPOInv;

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
    public $showModal = false;
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


    public bool $isLoading = false;

    public function initLoading()
    {
        $this->isLoading = true;
    }
    public function openModal() {
        $this->showModal = true;
        $this->mount();
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
        $this->vendors = EMVendor::orderBy('VendorName', 'asc')->get();
        $this->Price1 = (float) 7.6;
        $this->Scaler = 'A';
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
    public function render()
    {
        // $webappPOInvs = WebappPOInv::orderBy('DocuDate', 'desc')->paginate(10);
        $latestDate = WebappPOInv::max('DocuDate'); // ค้นหาวันที่ล่าสุด
        $webappPOInvs = WebappPOInv::where('DocuDate', $latestDate)
            ->orderBy('POInvID', 'desc')
            ->paginate(10);
        $POInvDTCars = POInvDTCar::all();
        return view('livewire.rpo.palm-purchase-live', [
            'webappPOInvs' => $webappPOInvs,
            'POInvDTCars' => $POInvDTCars,
        ]);
    }
    public function closeModal()
    {
        $this->resetInputFields();
        $this->showModal = false;
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
                'Price1' => 'required',
                'Grade' => 'required',
                'Impurity' => 'required',
                'Scaler' => 'required',
            ]
        );
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
}
