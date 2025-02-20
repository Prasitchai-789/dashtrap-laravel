<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'รายงานการรับซื้อผลปาล์ม'])
    <div class="grid gap-5 mb-2 xl:grid-cols-4 md:grid-cols-2">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                    <h5 class="truncate card-title font-prompt">จำนวนรายการ</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">{{ number_format($totalItemOfDate, 0, '.', ',') }}
                        <span class="text-sm"> รายการ</span>
                    </h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">{{ number_format($progressItem, 0) }}%</span>
                        @if ($progressItem > 70)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-primary" role="progressbar"
                        aria-valuenow="{{ $progressItem }}" aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $progressItem }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                    <h5 class="truncate card-title font-prompt">เกษตรกร</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">{{ number_format($sumAgrOfDate, 0, '.', ',') }}
                        <span class="text-sm"> kg.</span>
                    </h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">{{ number_format($progressAgr, 0) }}%</span>
                        @if ($progressAgr > 9)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-danger" role="progressbar"
                        aria-valuenow="{{ $progressAgr }}" aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $progressAgr }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                    <h5 class="truncate card-title font-prompt">ลานเท</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">{{ number_format($sumRamOfDate, 0, '.', ',') }}
                        <span class="text-sm"> kg.</span>
                    </h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">{{ number_format($progressRam, 0) }}%</span>
                        @if ($progressRam > 91)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-warning" role="progressbar"
                        aria-valuenow="{{ $progressRam }}" aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $progressRam }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                    <h5 class="truncate card-title font-prompt">ปริมาณผลปาล์ม</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">{{ number_format($totalPalmOfDate, 0, '.', ',') }}
                        <span class="text-sm">kg.</span>
                    </h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">{{ number_format($progressFFB, 0) }}%</span>
                        @if ($progressFFB > 70)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-success" role="progressbar"
                        aria-valuenow="{{ $progressFFB }}" aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $progressFFB }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>
    </div>
    <div class="overflow-auto card">
        <div class="mt-6 mb-3">
            <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                <!-- ส่วนเลือกวันที่ -->
                <div class="flex items-center mx-8">
                    <label for="selectedDate"
                        class="items-center inline-block text-sm font-medium text-default-800 me-2 font-anuphan">เลือกวันที่</label>
                    <div class="md:col-span-3">
                        <input class="font-semibold text-blue-900 rounded-lg form-input focus:ring-blue-500 focus:border-blue-500"
                            type="date" id="selectedDate" wire:model="selectedDate" wire:change="setDate">
                    </div>
                </div>

                <!-- ส่วนแสดงวันที่ -->
                <h5 class="text-2xl text-center card-title font-prompt">
                    ข้อมูลการรับซื้อผลปาล์ม <br class="sm:hidden">
                    <span class="text-blue-500">
                        {{ \Carbon\Carbon::parse($selectedDate)->locale('th')->translatedFormat('d F Y') }}
                    </span>
                </h5>
                <h5></h5>
            </div>

        </div>
        <div class="grid grid-cols-1 gap-5 mb-5 md:grid-cols-2 xl:grid-cols-3">
            <div class="mx-4 mt-6">
                <div class="mb-4 card border-left-blue">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="px-1 py-0.5 text-[10px] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                            <h5 class="truncate card-title font-prompt">ปริมาณการรับซื้อผลปาล์ม</h5>
                        </div>
                        <div class="flex items-center justify-end mb-4">
                            <h2 class="text-3xl font-bold text-default-800">{{ number_format($totalPalmOfDate, 0, '.', ',') }}
                                <span class="text-sm font-anuphan"> kg.</span>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="mb-4 card border-left-green">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="px-1 py-0.5 text-[10px] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                            <h5 class="truncate card-title font-prompt">ยอดเงิน</h5>
                        </div>
                        <div class="flex items-center justify-end mb-4">
                            <h2 class="text-3xl font-bold text-default-800">{{ number_format($totalAmnt2OfDate, 3, '.', ',') }}
                                <span class="text-sm font-anuphan"> MB</span>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="mb-4 card border-left-red">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="px-1 py-0.5 text-[10px] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                            <h5 class="truncate card-title font-prompt">ราคาเฉลี่ย</h5>
                        </div>
                        <div class="flex items-center justify-end mb-4">
                            <h2 class="text-3xl font-bold text-default-800">{{ number_format($AvgPrice, 2, '.', ',') }}
                                <span class="text-sm font-anuphan"> บาท/kg.</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-2 md:col-span-1 sm:mx-4">
                <div class="mr-4">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead>
                                        <tr class="text-lg font-bold font-prompt">
                                            <th class="px-6 py-2 text-start text-default-500">ชื่อลูกค้า</th>
                                            <th class="px-6 py-2 text-start text-default-500">น้ำหนัก</th>
                                            <th class="px-6 py-2 text-start text-default-500">ราคาเฉลี่ย</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                        @foreach ($sumVendors as $vendor)
                                        <tr class="text-xl font-anuphan">
                                            <td class="px-6 py-2 text-sm font-medium whitespace-nowrap text-default-800">
                                                {{ $vendor->empVendor->VendorName }}</td>
                                            <td class="px-6 py-2 text-sm font-bold whitespace-nowrap text-default-800">
                                                {{ number_format($vendor->totalGoodNet, 2) }} </td>
                                            @if ($AvgPrice < $vendor->avgPrice)
                                            <td class="px-6 py-2 text-sm font-bold text-red-500 whitespace-nowrap">
                                                {{ number_format($vendor->avgPrice, 2) }}
                                            </td>
                                            @else
                                            <td class="px-6 py-2 text-sm font-bold text-default-800 whitespace-nowrap">
                                                {{ number_format($vendor->avgPrice, 2) }}
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    {{-- <div class="mt-2 card">
        <div class="card">
            <div class="p-6">
                <h4 class="mb-4 card-title">Column with Data Labels</h4>

                <div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
            </div>
        </div><!--end card-->
    </div> --}}
</div>
