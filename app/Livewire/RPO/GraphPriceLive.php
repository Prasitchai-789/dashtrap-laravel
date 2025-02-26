<?php

namespace App\Livewire\RPO;

use Livewire\Component;
use App\Models\RPO\AveragePrice;

class GraphPriceLive extends Component
{
    public function render()
    {
        $averagePrices = AveragePrice::latest('created_at')->first();

    if ($averagePrices) {
        // แปลงข้อมูลสำหรับ ApexCharts
        $categories = [
            'หน้าป้าย',
            'อีสานปาล์ม',
            'สุขสมบูรณ์ สกลนคร',
            'แอ๊บโซลูท',
            'สุขสมบูรณ์ ชลบุรี',
            'วิจิตรภัณฑ์',
            'ยูนิวานิช',
        ];

        // ดึงข้อมูลในแต่ละคอลัมน์มาใช้ในการแสดงกราฟ
        $data = [
            $averagePrices->price_font,
            $averagePrices->price_isp,
            $averagePrices->price_ssg_sakon,
            $averagePrices->price_app,
            $averagePrices->price_ssg_chon,
            $averagePrices->price_wijit,
            $averagePrices->price_uni,


        ];
    } else {
        // ถ้าไม่มีข้อมูลล่าสุดให้ใช้ค่าเริ่มต้น
        $categories = [];
        $data = [];
    }

        return view('livewire.rpo.graph-price-live', [
            'averagePrices' => $averagePrices,
            'categories' => $categories,
            'data' => $data,
        ]);
    }
}
