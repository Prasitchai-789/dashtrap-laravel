<div>

    <div class="flex grid items-center justify-center gap-4 mt-12 lg:grid-cols-3 md:grid-cols-1">


        <div class="flex items-center">
            <label for="goodCode" class="w-32 mr-2 text-base font-medium text-default-800 font-anuphan text-end">เลือกสินค้า</label>

            <select type="text"
                class="font-semibold text-blue-900 form-select rounded-se focus:ring-blue-500 focus:border-blue-500 font-anuphan"
                id="goodCode" name="goodCode" wire:model="goodCode" required wire:change="loadData">
                <option selected value="S-FG-CPO-0001" class="font-anuphan">น้ำมันปาล์มดิบ</option>
                <option selected value="S-FG-PKN-0001" class="font-anuphan">เมล็ดในปาล์ม</option>
                <option selected value="S-FG-FS-0001" class="font-anuphan">กะลาปาล์ม (เพียว)</option>
                <option selected value="S-FG-EFB-0001" class="font-anuphan">ทะลายปาล์มเปล่า</option>
            </select>
        </div>

        <div class="flex items-center">
            <label for="startDate"
                class="items-center inline-block w-32 font-medium text-md text-default-800 me-2 font-anuphan ">เลือกวันที่</label>
            <div class="mr-2 md:col-span-3">
                <input
                    class="font-semibold text-blue-900 rounded-lg form-input focus:ring-blue-500 focus:border-blue-500"
                    type="date" id="startDate" wire:model.lazy="startDate" wire:change="">
            </div>
            <label for="endDate"
                class="items-center inline-block w-32 font-medium text-md text-default-800 me-2 font-anuphan ">ถึงวันที่</label>
            <div class="md:col-span-3">
                <input
                    class="font-semibold text-blue-900 rounded-lg form-input focus:ring-blue-500 focus:border-blue-500"
                    type="date" id="endDate" wire:model.lazy="endDate" wire:change="loadData">
            </div>
        </div>
    </div>

    <div class="mt-2 overflow-hidden card">
        <div class="flex items-center justify-center mt-2 card-header">
            <h4 class="text-lg text-blue-500 card-title font-prompt">รหัสสินค้า : {{$goodCode}}    {{$productName}}</h4>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto custom-scroll">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-300">
                            <thead>
                                <tr class="text-base font-bold font-anuphan text-default-800 text-end">
                                    <th scope="col" class="px-6 py-3">
                                        เดือน</th>
                                    <th scope="col" class="px-6 py-3">
                                        จำนวนตาชั่ง
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        น้ำหนักปลายทาง
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ยอดรวม
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        ราคาเฉลี่ย
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                @foreach ($monthlySummary as $data)
                                <tr>
                                    <td class="px-6 py-2.5 text-sm whitespace-nowrap text-default-800 text-end">
                                        {{ Carbon\Carbon::parse($data['month'])->translatedFormat('F Y') }}
                                    </td>
                                    <td class="px-6 py-2.5 text-sm whitespace-nowrap text-default-800 text-end">
                                        {{ number_format($data['total_weight'], 2) }}
                                    </td>
                                    <td class="px-6 py-2.5 text-sm whitespace-nowrap text-default-800 text-end">
                                        {{ number_format($data['quantity'], 2) }}
                                    </td>
                                    <td class="px-6 py-2.5 text-sm whitespace-nowrap text-default-800 text-end">
                                        {{ number_format($data['total_amount'], 2) }}
                                    </td>
                                    <td class="px-6 py-2.5 text-sm text-center whitespace-nowrap text-default-800">
                                        {{ number_format($data['avg_price'], 2) }}
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="font-bold font-base text-end">
                                    <td class="px-6 py-2.5 whitespace-nowrap text-default-800 text-end font-anuphan">
                                        ยอดรวม
                                    </td>
                                    <td class="px-6 py-2.5 whitespace-nowrap text-default-800 text-end">
                                        {{ number_format($yearlySummary['total_weight'], 2) }}
                                    </td>
                                    <td class="px-6 py-2.5 whitespace-nowrap text-default-800 text-end">
                                        {{ number_format($yearlySummary['quantity'], 2) }}
                                    </td>
                                    <td class="px-6 py-2.5 whitespace-nowrap text-default-800 text-end">
                                        {{ number_format($yearlySummary['total_amount'], 2) }}
                                    </td>
                                    <td class="px-6 py-2.5 text-center whitespace-nowrap text-default-800">
                                        {{ number_format($yearlySummary['avg_price'], 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card -->
    <div wire:init="loadData">
    <div wire:loading wire:target="loadData" wire:key="loading-spinner" id="loading" class="fixed px-5 py-3 text-lg font-bold text-white transform -translate-x-1/2 -translate-y-1/2 rounded-lg font-prompt top-1/2 left-1/2 bg-black/70">
        กำลังโหลด...
        <button type="button" class="inline-flex items-center justify-center gap-3 px-5 py-2 text-base font-semibold tracking-wide text-center align-middle duration-500 rounded-full cursor-default border-primary/10 text-primary hover:text-white">
            <div class="animate-spin w-5 h-5 border-[3px] border-current border-t-transparent rounded-full" role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
            Loading...
        </button> <!-- button-end -->
    </div>
</div>

</div>
