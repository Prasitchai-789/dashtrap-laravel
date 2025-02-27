<div>
    @include('layouts.root/page-title', ['subtitle' => 'รายงานฝ่ายจัดซื้อปาล์ม', 'title' => 'รายงานการรับซื้อ'])

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
            <h1></h1>

        </div>

    </div>
    <div class="grid gap-5 mb-2 xl:grid-cols-4 md:grid-cols-2">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Wins of Daily</span>
                    <h5 class="truncate card-title font-prompt">ราคาเฉลี่ย</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">{{ number_format($AvgPrice, 2, '.', ',') }}
                        <span class="text-sm font-anuphan"> บาท/kg.</span>
                    </h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">{{ number_format($progressMaxPrice2, 0) }}%</span>
                        @if ($progressMaxPrice2 < $avgPrice2)
                        <i class="fa-solid fa-arrow-down text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-up text-danger ms-2"></i>
                        @endif
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-danger" role="progressbar"
                        aria-valuenow="{{ $progressMaxPrice2 }}" aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $progressMaxPrice2 }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span
                    class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Wins of Daily</span>
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
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-success" role="progressbar"
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
                    class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Wins of Daily</span>
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
                    class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Wins of Daily</span>
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
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-primary" role="progressbar"
                        aria-valuenow="{{ $progressFFB }}" aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $progressFFB }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
        </div>
    </div>
    <div class="overflow-auto card">
        <div class="grid grid-cols-1 gap-5 mb-5 md:grid-cols-2 xl:grid-cols-3">
            <div class="mx-4 mt-4">
                <h1 class="text-xl font-bold text-center font-anuphan text-default-700">การรับซื้อผลปาล์มประจำเดือน <span class="text-blue-500">
                    {{ \Carbon\Carbon::parse($selectedDate)->locale('th')->translatedFormat('F Y') }}
                </span></h1>
                <div class="mt-4 mb-4 card border-left-blue">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-blue-500 bg-primary/20 float-end">Wins Of Month</span>
                            <h5 class="truncate card-title font-prompt">ยอดรวมผลปาล์มทั้งเดือน</h5>
                        </div>
                        <div class="flex items-center justify-end mb-4">
                            <h2 class="text-3xl font-bold text-default-800">{{ number_format($totalPalmOfMonth, 0, '.', ',') }}
                                <span class="text-sm font-anuphan"> kg.</span>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="mb-4 card border-left-green">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-blue-500 bg-primary/20 float-end">Wins Of Month</span>
                            <h5 class="truncate card-title font-prompt">ยอดเงินทั้งเดือน</h5>
                        </div>
                        <div class="flex items-center justify-end mb-4">
                            <h2 class="text-3xl font-bold text-default-800">{{ number_format($totalAmnt2OfMonth, 3, '.', ',') }}
                                <span class="text-sm font-anuphan"> MB</span>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="mb-4 card border-left-red">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-blue-500 bg-primary/20 float-end">Wins Of Month</span>
                            <h5 class="truncate card-title font-prompt">ราคาเฉลี่ย / เดือน</h5>
                        </div>
                        <div class="flex items-center justify-end mb-4">
                            <h2 class="text-3xl font-bold text-default-800">{{ number_format($avgPriceOfMonth, 2, '.', ',') }}
                                <span class="text-sm font-anuphan"> บาท/kg.</span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 xl:col-span-2 md:col-span-1 sm:mx-4">
                <div class="mr-4">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden">
                                <h1 class="text-xl font-bold text-center font-anuphan text-default-700">กราฟแสดงราคาเฉลี่ย <span class="text-blue-500">ย้อนหลัง 7 วัน
                                </span></h1>
                                <div id="report-purchase" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-2 overflow-auto card">
        <h1 class="mt-4 text-xl font-bold text-center font-anuphan text-default-700">กราฟแสดงปริมาณการรับซื้อผลปาล์มประจำเดือน <span class="text-blue-500">
            {{ \Carbon\Carbon::parse($selectedDate)->locale('th')->translatedFormat('F Y') }}
        </span> (ตัน)</h1>
        <div id="graph-palm-date" class="m-2 mt-4 apex-charts" dir="ltr"></div>
    </div>
</div>

<script>
    const categories = @json($formattedDates);
    const dataSeries = @json($avgPrices);

    const categoriesGD = @json($categoriesGD);
    const rawData = @json($dataSeriesGD);
    const dataSeriesGD = Array.isArray(rawData)
        ? rawData.map(value => {
            // ถ้าค่าที่ได้เป็น 0, null หรือ undefined จะเปลี่ยนเป็น null
            return (value === null || value === undefined || value === 0) ? null : value;
        })
        : [];
</script>
