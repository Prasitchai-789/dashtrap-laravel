<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'รายการขายสินค้า'])

    <div class="page-header">
        <div class="grid gap-5 mb-4 xl:grid-cols-4 md:grid-cols-2">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <span
                            class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                        <h5 class="truncate card-title font-prompt">น้ำมันปาล์มดิบ</h5>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-3xl font-medium text-default-800">{{ number_format($sumOfDateCPO, 0, '.', ',')
                            }} <span class="text-sm">kg.</span></h2>
                        @if ($progressCPO > 0)
                        <span class="flex items-center">
                            <span class="text-sm text-default-400">{{ number_format($progressCPO, 0) }}%</span>
                            @if ($progressCPO > 60)
                            <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                            @else
                            <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                            @endif
                        </span>
                        @endif
                    </div>

                    <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                        <div class="flex flex-col justify-center overflow-hidden rounded-full bg-warning"
                            role="progressbar" aria-valuenow="{{ $progressCPO }}" aria-valuemin="0" aria-valuemax="100"
                            style="width: {{ $progressCPO }}%;">
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
                        <h5 class="truncate card-title font-prompt">เมล็ดในปาล์ม</h5>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-3xl font-medium text-default-800">{{ number_format($sumOfDatePKN, 0, '.', ',')
                            }} <span class="text-sm">kg.</span></h2>
                        @if ($progressPKN > 0)
                        <span class="flex items-center">
                            <span class="text-sm text-default-400">{{ number_format($progressPKN, 0) }}%</span>
                            @if ($progressPKN > 60)
                            <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                            @else
                            <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                            @endif
                        </span>
                        @endif

                    </div>

                    <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                        <div class="flex flex-col justify-center overflow-hidden rounded-full bg-success"
                            role="progressbar" aria-valuenow="{{ $progressPKN }}" aria-valuemin="0" aria-valuemax="100"
                            style="width: {{ $progressPKN }}%;">
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
                        <h5 class="truncate card-title font-prompt">กะลาปาล์ม (เพียว)</h5>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-3xl font-medium text-default-800">{{ number_format($sumOfDateShell, 0, '.', ',')
                            }} <span class="text-sm">kg.</span></h2>
                        @if ($progressShell > 0)
                        <span class="flex items-center">
                            <span class="text-sm text-default-400">{{ number_format($progressShell, 0) }}%</span>
                            @if ($progressShell > 60)
                            <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                            @else
                            <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                            @endif
                        </span>
                        @endif
                    </div>

                    <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                        <div class="flex flex-col justify-center overflow-hidden rounded-full bg-danger"
                            role="progressbar" aria-valuenow="{{ $progressShell }}" aria-valuemin="0"
                            aria-valuemax="100" style="width: {{ $progressShell }}%;">
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
                        <h5 class="truncate card-title font-prompt">ทะลายปาล์มเปล่า</h5>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-3xl font-medium text-default-800">{{ number_format($sumOfDateEFB, 0, '.', ',')
                            }} <span class="text-sm">kg.</span></h2>
                        @if ($progressEFB > 0)
                        <span class="flex items-center">
                            <span class="text-sm text-default-400">{{ number_format($progressEFB, 0) }}%</span>
                            @if ($progressEFB > 60)
                            <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                            @else
                            <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                            @endif
                        </span>
                        @endif
                    </div>

                    <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                        <div class="flex flex-col justify-center overflow-hidden rounded-full bg-primary"
                            role="progressbar" aria-valuenow="{{ $progressEFB }}" aria-valuemin="0" aria-valuemax="100"
                            style="width: {{ $progressEFB }}%;">
                        </div>
                    </div>
                </div>
                <!--end card body-->
            </div>
        </div>
    </div>
    <div class="page-header">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between mb-2">
                <!-- ส่วนของ Input วันที่ -->
                <div class="flex items-center">
                    <label for="selectedDate"
                        class="items-center inline-block text-sm font-medium text-default-800 me-2 font-anuphan">เลือกวันที่</label>
                    <div class="md:col-span-3">
                        <input
                            class="font-semibold text-blue-900 rounded-lg form-input focus:ring-blue-500 focus:border-blue-500"
                            type="date" id="selectedDate" wire:model="selectedDate" wire:change="SelectedDate">
                    </div>
                </div>
            </div>


            <!-- Table -->
            <div class="inline-block min-w-full align-middle sm:overflow-auto">
                <div class="rounded-lg font-anuphan">
                    <table class="min-w-full divide-y divide-default-200">
                        <thead class="text-center bg-gray-200">
                            <tr class="border">
                                <th class="p-3 border">ชื่อสินค้า</th>
                                <th class="p-3 border">ทะเบียนรถ</th>
                                <th class="p-3 border">ชื่อคู่ค้า</th>
                                <th class="p-3 border">แผนการโหลด (kg.)</th>
                                <th class="p-3 border">นน.สุทธิ (kg.)</th>
                                <th class="p-3 border">สถานะ</th>
                                <th class="p-3 text-center border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesPlans as $salesPlan)
                            <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                <td class="p-2 text-center border min-w-[60px] max-w-[80px] truncate">
                                    {{ $salesPlan->GoodName }}
                                </td>

                                <td class="p-2 pl-4 border min-w-[80px] max-w-[80px] truncate">
                                    {{ $salesPlan->NumberCar }}
                                </td>

                                <td class="p-2 pl-4 border min-w-[60px] max-w-[150px] truncate">
                                    {{ $salesPlan->emCust->CustName }}
                                </td>

                                <td class="p-2 pr-4 mr-4 font-bold border text-end">
                                    {{ isset($salesPlan->AmntLoad) ? number_format($salesPlan->AmntLoad, 0, '.', ',') :
                                    '-' }}
                                </td>
                                <td class="p-2 pr-4 mr-4 font-bold border text-end">
                                    {{ isset($salesPlan->NetWei) ? number_format($salesPlan->NetWei, 0, '.', ',') :
                                    '-' }}
                                </td>

                                <td class="p-2 text-center border min-w-[50px] max-w-[50px] truncate">
                                    @if($salesPlan->Status == 'F')
                                    <span class="px-3 py-1 text-white rounded-full btn bg-green-500 min-w-[100px] max-w-[100px]">Finish</span>
                                    @elseif($salesPlan->Status == 'W')
                                    <button type="button"
                                        class="px-3 py-1 border rounded-full btn border-warning text-warning hover:bg-warning hover:text-white min-w-[100px] max-w-[100px]"
                                        wire:click='changeStatus({{ $salesPlan->SOPID }})'>Waiting
                                    </button>
                                    @elseif($salesPlan->Status == 'P')
                                    <button type="button"
                                        class="px-3 py-1 border rounded-full btn bg-blue-500  text-white hover:border-primary hover:bg-white hover:text-primary min-w-[100px] max-w-[100px]"
                                        wire:click='confirmSave({{ $salesPlan->SOPID }})'>Processing
                                    </button>
                                    @endif
                                </td>

                                <td class="p-2 text-center border min-w-[30px] max-w-[40px] relative">
                                    <div class="relative text-center" x-data="{ open: false }">
                                        <a href="#" class="text-gray-500 hover:text-gray-900 focus:outline-none"
                                            @click="open = !open">
                                            <div class="flex items-center justify-center">
                                                <p class="text-lg font-medium text-gray-900 dark:text-white hover:text-xl">...</p>
                                            </div>
                                        </a>
                                        <!-- Dropdown menu -->
                                        <div>
                                            <ul class="absolute right-0 top-full z-[9999] w-48 bg-white border border-gray-200 rounded-md shadow-lg transition-[opacity,margin] mt-2 p-1.5"
                                                x-show="open" @click.away="open = false" x-transition>
                                                @if ($salesPlan->Status == 'F')
                                                <li>
                                                    <a href="#" wire:click='confirmEdit({{ $salesPlan->SOPID }})'
                                                        data-bs-toggle="modal" data-hs-overlay="#modal-palm-purchase"
                                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-start">
                                                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit
                                                    </a>
                                                </li>
                                                @elseif ($salesPlan->Status == 'P')
                                                <li>
                                                    <a href="#"
                                                        data-bs-toggle="modal" data-hs-overlay="#modal-palm-purchase"
                                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-start">
                                                    </a>
                                                </li>
                                                @endif

                                                @can('delete IT')
                                                <li>
                                                    <a href="#" wire:click='confirmDelete({{ $salesPlan->SOPID }})'
                                                        class="block px-4 py-2 text-red-500 hover:bg-gray-100 text-start">
                                                        <i class="fa-solid fa-trash me-2"></i> Delete
                                                    </a>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </div>
                                </td>



                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex mt-4">
                        {{ $salesPlans->links() ?? '' }}
                    </div>
                </div>
            </div>
            <!-- End Table -->

            <!-- Model ADD  -->
            <x-modal title="แผนการโหลดสินค้า" wire:model="showModal" maxWidth="2xl" zIndex="20" closeModal="closeModal">

                <form wire:submit.prevent="{{ $edit ? ' updateWeight' : ' saveWeight' }}" id="formAddWeight">

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="GoodName"
                             class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ชื่อสินค้า
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-gift"></i>
                                </div>
                                <input type="text" placeholder="ชื่อสินค้า"
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="GoodName" name="GoodName" wire:model="GoodName" readonly/>
                            </div>
                        </div>
                        <div class="">
                            <label for="AmntLoad"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                แผนการโหลด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                                <input type="text" placeholder="กิโลกรัม"
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="AmntLoad" name="AmntLoad" wire:model="AmntLoad" readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="CustName"
                             class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                             ชื่อคู่ค้า
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <input type="text" placeholder="ชื่อคู่ค้า"
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="CustName" name="CustName" wire:model="CustName" readonly/>
                            </div>
                        </div>
                        <div class="">
                            <label for="Recipient"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ปลายทาง
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-download"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Recipient" name="Recipient" wire:model="Recipient"  readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="NumberCar"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ทะเบียนรถ
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-truck-moving"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="NumberCar" name="NumberCar" wire:model="NumberCar" readonly/>
                            </div>
                        </div>
                        <div class="">
                            <label for="DriverName"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ชื่อคนขับ
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500 me-2"
                                    id="DriverName" name="DriverName" wire:model="DriverName" readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="IBWei"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                น้ำหนักเข้า
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-truck-moving"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="IBWei" name="IBWei" wire:model="IBWei"  {{ $edit ? 'readonly' : ' ' }}/>
                            </div>
                        </div>
                        <div class="">
                            <label for="OBWei"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                น้ำหนักออก
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-truck-moving"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500 me-2"
                                    id="OBWei" name="OBWei" wire:model="OBWei"  required/>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                        <div class="">
                            <label for="NetWei"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                น้ำหนักสุทธิ
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-truck-moving"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="NetWei" name="NetWei" wire:model="NetWei" readonly/>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                        <div class="">
                            <label for="Remarks"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                หมายเหตุ
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <textarea type="text" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Remarks" name="Remarks" wire:model="Remarks">
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ปุ่ม submit -->
                    <div class="flex items-center justify-end px-4 py-3 mt-6 border-t gap-x-2 border-default-200">
                        <button type="submit" class="text-white btn bg-primary" href="#">
                            {{ $edit ? ' Update' : ' Save' }}
                        </button>
                    </div>
                </form>
            </x-modal>
            <!-- End Model ADD  -->

        </div>
    </div>



</div>
