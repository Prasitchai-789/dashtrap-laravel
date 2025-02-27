<?php

namespace App\Livewire\RPO;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RPO\AveragePrice;

class AveragePriceLive extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
    ];
    public $edit = false;
    public AveragePrice $averagePrice;
    public $showModal = false;
    public $deleteId;
    public $updateId;
    public $created_at;
    public $price_font;
    public $price_isp;
    public $price_ssg_sakon;
    public $price_app;
    public $price_ssg_chon;
    public $price_sang;
    public $price_see;
    public $price_wijit;
    public $price_uni;
    public $price_chaw;
    public $remark;
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


    public function mount()
    {
        $this->created_at = now()->subDay()->format('Y-m-d');
    }
    public function resetInputFields()
    {
        $this->price_font = '';
        $this->price_isp = '';
        $this->price_ssg_sakon = '';
        $this->price_app = '';
        $this->price_ssg_chon = '';
        $this->price_sang = '';
        $this->price_see = '';
        $this->price_wijit = '';
        $this->price_uni = '';
        $this->price_chaw = '';
        $this->remark = '';
    }
    public function render()
    {
        $averagePrices = AveragePrice::latest()->paginate(10);
        return view('livewire.rpo.average-price-live', [
            'averagePrices' => $averagePrices,
        ]);
    }
    public function saveAvgPrice()
    {
        try {
            $validatedData = $this->validate(
                [
                    'price_font' => 'nullable',
                    'price_isp' => 'nullable',
                    'price_ssg_sakon' => 'nullable',
                    'price_app' => 'nullable',
                    'price_ssg_chon' => 'nullable',
                    'price_sang' => 'nullable',
                    'price_see' => 'nullable',
                    'price_wijit' => 'nullable',
                    'price_uni' => 'nullable',
                    'price_chaw' => 'nullable',
                ]
            );
            $validatedData['created_at'] = $this->created_at;
            AveragePrice::create($validatedData);

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
        $this->showModal = true;
        $this->edit = true;
        $this->updateId = $id;
        $this->averagePrice = AveragePrice::find($id);
        $this->created_at = $this->averagePrice->created_at->format('Y-m-d');
        $this->price_font = number_format($this->averagePrice->price_font, 2);
        $this->price_isp = number_format($this->averagePrice->price_isp, 2);
        $this->price_ssg_sakon = number_format($this->averagePrice->price_ssg_sakon, 2);
        $this->price_app = number_format($this->averagePrice->price_app, 2);
        $this->price_ssg_chon = number_format($this->averagePrice->price_ssg_chon, 2);
        $this->price_sang = number_format($this->averagePrice->price_sang, 2);
        $this->price_see = number_format($this->averagePrice->price_see, 2);
        $this->price_wijit = number_format($this->averagePrice->price_wijit, 2);
        $this->price_uni = number_format($this->averagePrice->price_uni, 2);
        $this->price_chaw = number_format($this->averagePrice->price_chaw, 2);
    }

    public function updateAvgPrice()
    {
        try {
            $validatedData = $this->validate(
                [
                    'price_font' => 'nullable',
                    'price_isp' => 'nullable',
                    'price_ssg_sakon' => 'nullable',
                    'price_app' => 'nullable',
                    'price_ssg_chon' => 'nullable',
                    'price_sang' => 'nullable',
                    'price_see' => 'nullable',
                    'price_wijit' => 'nullable',
                    'price_uni' => 'nullable',
                    'price_chaw' => 'nullable',
                ]
            );

            $averagePrice = AveragePrice::find($this->updateId);
            $validatedData['created_at'] = $this->created_at;
            $averagePrice->update($validatedData);

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
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $averagePrice = AveragePrice::find($id);
        if ($averagePrice) {
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
        $averagePrice = AveragePrice::find($this->deleteId);
        if ($averagePrice) {
            $averagePrice->delete();
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
