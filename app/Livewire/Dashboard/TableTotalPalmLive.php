<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\WIN\WebappPOInv;

class TableTotalPalmLive extends Component
{
    public function render()
    {
        $monthlyGoodNet = WebappPOInv::selectRaw("
        MONTH(DocuDate) as month,
        SUM(CASE WHEN YEAR(DocuDate) = 2022 THEN GoodNet ELSE 0 END) as y2022,
        SUM(CASE WHEN YEAR(DocuDate) = 2023 THEN GoodNet ELSE 0 END) as y2023,
        SUM(CASE WHEN YEAR(DocuDate) = 2024 THEN GoodNet ELSE 0 END) as y2024,
        SUM(CASE WHEN YEAR(DocuDate) = 2025 THEN GoodNet ELSE 0 END) as y2025
    ")
            ->groupByRaw("MONTH(DocuDate)")
            ->orderByRaw("MONTH(DocuDate)")
            ->get();

        // รวมผลรวมทั้งปี
        $yearlyTotal = WebappPOInv::selectRaw("
        SUM(CASE WHEN YEAR(DocuDate) = 2022 THEN GoodNet ELSE 0 END) as y2022,
        SUM(CASE WHEN YEAR(DocuDate) = 2023 THEN GoodNet ELSE 0 END) as y2023,
        SUM(CASE WHEN YEAR(DocuDate) = 2024 THEN GoodNet ELSE 0 END) as y2024,
        SUM(CASE WHEN YEAR(DocuDate) = 2025 THEN GoodNet ELSE 0 END) as y2025
    ")->first();



        $manualData2021 = [
            1 => 2662670,
            2 => 2834180,
            3 => 12332920,
            4 => 18614350,
            5 => 20509670,
            6 => 18280820,
            7 => 20316810,
            8 => 23253700,
            9 => 22987040,
            10 => 17393480,
            11 => 8911810,
            12 => 40980
        ];

        // 📌 เพิ่มข้อมูลเข้า Collection
        $monthlyGoodNet = $monthlyGoodNet->map(function ($data) use ($manualData2021) {
            $month = $data->month;
            $data->y2021 = $manualData2021[$month] ?? 0;
            return $data;
        });
        $manualData2020 = [
            1 => 178347,
            2 => 819500,
            3 => 1756570,
            4 => 15762430,
            5 => 18820110,
            6 => 18595290,
            7 => 15028580,
            8 => 17140780,
            9 => 14391740,
            10 => 8902850,
            11 => 2486050,
            12 => 2715660
        ];

        // 📌 เพิ่มข้อมูลเข้า Collection
        $monthlyGoodNet = $monthlyGoodNet->map(function ($data) use ($manualData2020) {
            $month = $data->month;
            $data->y2020 = $manualData2020[$month] ?? 0;
            return $data;
        });

        return view('livewire.dashboard.table-total-palm-live', [
            'monthlyGoodNet' => $monthlyGoodNet,
            'yearlyTotal' => $yearlyTotal
        ]);
    }
}
