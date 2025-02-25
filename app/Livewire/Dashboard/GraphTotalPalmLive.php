<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\WIN\WebappPOInv;

class GraphTotalPalmLive extends Component
{

    public $selectedMonth; // เดือนที่เลือก
    public $monthNumber; // ตัวเลขเดือน
    public $categories = []; // ข้อมูลวัน
    public $dataSeries = []; // ข้อมูลผลรวม GoodNet

    public function mount()
    {
        // ตั้งค่าเดือนเริ่มต้น (เช่น เดือนปัจจุบัน)
        $this->selectedMonth = date('n');
        $this->monthNumber = $this->selectedMonth;
        $this->updateChartData();
    }

    public function setMonth()
    {
        $this->monthNumber = date('n', strtotime($this->selectedMonth));

        $this->updateChartData();
    }

    public function updateChartData()
    {
        // ดึงข้อมูลจากฐานข้อมูล
        $dailyGoodNet = WebappPOInv::selectRaw('
            MONTH(DocuDate) as month,
            DAY(DocuDate) as day,
            SUM(GoodNet) as total_goodnet
        ')

            ->whereRaw('MONTH(DocuDate) = ?', [$this->monthNumber]) // กรองเฉพาะเดือนที่เลือก
            ->groupByRaw('MONTH(DocuDate), DAY(DocuDate)')
            ->orderByRaw('DAY(DocuDate) ASC')
            ->get();
        // อัปเดตข้อมูลสำหรับกราฟ
        $this->categories = $dailyGoodNet->pluck('day')->toArray();
        $this->dataSeries = $dailyGoodNet->pluck('total_goodnet')->toArray();

        // ส่ง event เพื่ออัปเดตกราฟในฝั่ง JavaScript
        $this->dispatch('updateChart', [
            'categories' => $this->categories,
            'dataSeries' => $this->dataSeries,
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.graph-total-palm-live');
    }
}
