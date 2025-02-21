<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\WIN\WebappPOInv;
use Illuminate\Support\Facades\DB;

class GraphPalmPurchaseLive extends Component
{
    public $monthlyGoodNet;
    public function render()
    {
        $monthlyGoodNet = WebappPOInv::select(
            DB::raw('MONTH(DocuDate) as month'),
            DB::raw('SUM(GoodNet) as total_good_net')
        )
            ->whereYear('DocuDate', 2025) // กรองเฉพาะปี 2025
            ->groupBy(DB::raw('MONTH(DocuDate)'))
            ->orderBy(DB::raw('MONTH(DocuDate)'))
            ->get()
            ->keyBy('month');

        $categories = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $data[] = $monthlyGoodNet[$month]->total_good_net ?? 0;
        }
        return view('livewire.dashboard.graph-palm-purchase-live', [
            'categories' => $categories, // ส่ง categories ไปที่ View
            'data' => $data, // ส่งข้อมูลไปที่ View
        ]);
    }
}
