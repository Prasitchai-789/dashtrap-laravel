<div>
    <!-- ส่วนเลือกสินค้าและวันที่ -->
    <div class="flex flex-col gap-4 mt-12 lg:grid lg:grid-cols-3 lg:items-center lg:justify-center md:grid-cols-1">
        <!-- เลือกสินค้า -->
        <div class="flex items-center lg:flex-row">
            <label for="goodCode" class="w-32 p-1.5 text-base font-medium text-center bg-gray-200 border text-default-800 font-anuphan lg:text-end border-default-200 bg-default-100 rounded-s-md border-e-0">
                เลือกสินค้า
            </label>
            <select
                class="w-full font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500 font-anuphan"
                id="goodCode" name="goodCode" wire:model="goodCode" required wire:change="loadData">
                <option value="S-FG-CPO-0001">น้ำมันปาล์มดิบ</option>
                <option value="S-FG-PKN-0001">เมล็ดในปาล์ม</option>
                <option value="S-FG-FS-0001">กะลาปาล์ม (เพียว)</option>
                <option value="S-FG-EFB-0001">ทะลายปาล์มเปล่า</option>
            </select>
        </div>

        <!-- เลือกวันที่ -->
        <div class="flex items-center lg:flex-row">
            <label for="startDate" class="w-32 p-1.5 text-base font-medium text-center bg-gray-200 border text-default-800 font-anuphan lg:text-end border-default-200 bg-default-100 rounded-s-md border-e-0">
                เลือกวันที่
            </label>
            <input
                class="w-full font-semibold text-blue-900 rounded-lg rounded-s-none form-input focus:ring-blue-500 focus:border-blue-500"
                type="date" id="startDate" wire:model.lazy="startDate" wire:change="">
        </div>

        <!-- เลือกถึงวันที่ -->
        <div class="flex items-center lg:flex-row">
            <label for="endDate" class="w-32 p-1.5 text-base font-medium text-center bg-gray-200 border text-default-800 font-anuphan lg:text-end border-default-200 bg-default-100 rounded-s-md border-e-0">
                ถึงวันที่
            </label>
            <input
                class="w-full font-semibold text-blue-900 rounded-lg rounded-s-none form-input focus:ring-blue-500 focus:border-blue-500"
                type="date" id="endDate" wire:model.lazy="endDate" wire:change="loadData">
        </div>
    </div>

    <!-- ตารางสรุปข้อมูล -->
    <div class="mt-4 overflow-hidden card">
        <div class="flex items-center justify-center mt-2 card-header">
            <h4 class="text-lg text-blue-500 card-title font-prompt">รหัสสินค้า : {{$goodCode}} {{$productName}}</h4>
        </div>
    </div> <!-- end card -->

    <div class="mt-2 overflow-auto align-middle rounded-lg font-anuphan card">
        <div class="overflow-x-auto rounded-lg font-anuphan">
            <table class="w-full border border-collapse">
                <thead class="text-center text-white bg-primary/50">
                    <tr class="text-base font-bold text-blue-900 font-anuphan text-end">
                        <th scope="col" class="px-4 py-2 sm:px-6 sm:py-3">เดือน</th>
                        <th scope="col" class="px-4 py-2 sm:px-6 sm:py-3">น้ำหนักตาชั่ง</th>
                        <th scope="col" class="px-4 py-2 sm:px-6 sm:py-3">น้ำหนักปลายทาง</th>
                        <th scope="col" class="px-4 py-2 sm:px-6 sm:py-3">ยอดรวม</th>
                        <th scope="col" class="px-4 py-2 text-center sm:px-6 sm:py-3">ราคาเฉลี่ย</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-default-200">
                    @foreach ($monthlySummary as $data)
                    <tr>
                        <td class="px-4 py-2 text-sm whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5">
                            {{ Carbon\Carbon::parse($data['month'])->translatedFormat('F Y') }}
                        </td>
                        <td class="px-4 py-2 text-sm whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5">
                            {{ number_format($data['total_weight'], 2) }}
                        </td>
                        <td class="px-4 py-2 text-sm whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5">
                            {{ number_format($data['quantity'], 2) }}
                        </td>
                        <td class="px-4 py-2 text-sm whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5">
                            {{ number_format($data['total_amount'], 2) }}
                        </td>
                        <td class="px-4 py-2 text-sm text-center whitespace-nowrap text-default-800 sm:px-6 sm:py-2.5">
                            {{ number_format($data['avg_price'], 2) }}
                        </td>
                    </tr>
                    @endforeach
                    <tr class="text-base font-bold text-end">
                        <td class="px-4 py-2 whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5 font-anuphan">
                            ยอดรวม
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5">
                            {{ number_format($yearlySummary['total_weight'], 2) }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5">
                            {{ number_format($yearlySummary['quantity'], 2) }}
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-default-800 text-end sm:px-6 sm:py-2.5">
                            {{ number_format($yearlySummary['total_amount'], 2) }}
                        </td>
                        <td class="px-4 py-2 text-center whitespace-nowrap text-default-800 sm:px-6 sm:py-2.5">
                            {{ number_format($yearlySummary['avg_price'], 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Loading Spinner -->
    <div wire:init="loadData" class="flex items-center justify-center">
        <div wire:loading wire:target="loadData" wire:key="loading-spinner" id="loading"
            class="fixed flex flex-col items-center justify-center px-5 py-3 text-lg font-bold text-white transform -translate-x-1/2 -translate-y-1/2 rounded-lg font-prompt top-1/2 left-1/2 bg-black/70 w-[90%] max-w-[300px] text-center">
            <span class="mb-2">กำลังโหลด...</span>
            <button type="button"
                class="inline-flex flex-col items-center justify-center gap-3 px-5 py-2 text-base font-semibold tracking-wide text-center align-middle duration-500 rounded-full cursor-default sm:flex-row border-primary/10 text-primary hover:text-white">
                <div class="animate-spin w-5 h-5 border-[3px] border-current border-t-transparent rounded-full"
                    role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                </div>
                <span>Loading...</span>
            </button>
        </div>
    </div>
</div>
