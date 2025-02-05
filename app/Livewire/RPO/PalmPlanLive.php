<?php

namespace App\Livewire\RPO;

use Telegram\Bot\Api;
use Livewire\Component;
use App\Models\RPO\PalmPlan;
use Illuminate\Support\Facades\Http;

class PalmPlanLive extends Component
{
    protected $paginationTheme = 'tailwind';
    protected $listeners = [
        'deleteConfirmed' => 'deleteItem',
    ];
    public $edit = false;
    public PalmPlan $palmPlan;
    public $showModal = false;
    public $deleteId;
    public $updateId;
    public $list_plan;
    public $palm_plan;
    public $actual_plan;
    public $per_plan;
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
    public function addEmployee()
    {
        $this->edit = false;
    }
    public function mount()
    {
        //
    }
    public function sendToDiscord($message)
    {
        $webhookUrl = config('services.discord.webhook_url'); // ดึง Webhook URL จากไฟล์ config

        // ส่งข้อความไปยัง Discord
        Http::post($webhookUrl, [
            'content' => $message, // เนื้อหาของข้อความ
        ]);
    }
    public function sendToTelegram($message)
{
    $telegram = new Api(config('services.telegram.bot_token'));
    $chatId = env('TELEGRAM_CHAT_ID');

    $telegram->sendMessage([
        'chat_id' => $chatId,
        'text' => $message,
    ]);
}
    public function notify()
    {
        $this->sendToDiscord('ข้อความที่ต้องการส่งไปยัง Discord');
        $this->sendToTelegram("ทดสอบส่งข้อความจาก Laravel ไปยัง Telegram!");
    }
    public function render()
    {
        $palmPlans = PalmPlan::all();
        return view('livewire.rpo.palm-plan-Live', [
            'palmPlans' => $palmPlans,
        ]);
    }
    public function resetInputFields()
    {
        //
    }
    public function savePalm()
    {
        $validatedData = $this->validate(
            [
                'list_plan' => 'required',
                'palm_plan' => 'required',
                'actual_plan' => 'nullable',
                'per_plan' => 'nullable',
            ]
        );
        $validatedData['per_plan'] = number_format(($this->actual_plan / $this->palm_plan) * 100, 2, '.', '');
        PalmPlan::create($validatedData);
        $message ="แจ้งแผน" .
        "\n" . ' 🌴 แผนรับเข้า'." : ".$this->palm_plan;
        $this->sendToTelegram($message);
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
    public function confirmEdit($id)
    {
        $this->showModal = true;
        $this->edit = true;
        $this->updateId = $id;
        $palmPlan = PalmPlan::find($id);
        $this->list_plan = $palmPlan->list_plan;
        $this->palm_plan = $palmPlan->palm_plan;
        $this->actual_plan = $palmPlan->actual_plan;
        $this->per_plan = $palmPlan->per_plan;
    }

    public function updatePlan()
    {
        $validatedData = $this->validate(
            [
                'list_plan' => 'required',
                'palm_plan' => 'required',
                'actual_plan' => 'nullable',
            ]
        );

        $palmPlan = PalmPlan::find($this->updateId);
        $validatedData['per_plan'] = number_format(($this->actual_plan / $this->palm_plan) * 100, 2, '.', '');

        if ($palmPlan) {
            $palmPlan->update($validatedData);
        } else {
            // สร้างใหม่ถ้าไม่มีข้อมูล
            PalmPlan::create($validatedData);
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

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $palmPlan = PalmPlan::find($id);
        $this->dispatch(
            'alertConfirmDelete',
            [
                'deleteId' => $this->deleteId,
            ]
        );
        if ($palmPlan) {
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
        $palmPlan = PalmPlan::find($this->deleteId);
        if ($palmPlan) {
            $palmPlan->delete();
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
