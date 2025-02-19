<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายขายและการตลาด', 'title' => 'แผนการขายสินค้า'])

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
                    <!-- ส่วนของปุ่มต่างๆ -->
                    <button type="button"
                        class="px-4 py-2 text-sm font-bold text-white transition rounded-lg bg-primary hover:bg-blue-500"
                        wire:click='openModal'>
                        CREATE
                    </button>
                </div>


                <!-- Table -->
                <div class='overflow-auto rounded-lg'>
                    <div class="rounded-lg font-anuphan">
                        <table class="w-full border border-collapse">
                            <thead class="text-center text-white bg-success">
                                <tr class="border">
                                    <th class="p-3 border">วันที่</th>
                                    <th class="p-3 border">ชื่อสินค้า</th>
                                    <th class="p-3 border">ทะเบียนรถ</th>
                                    <th class="p-3 border">ชื่อคู่ค้า</th>
                                    <th class="p-3 border">น้ำหนักสุทธิ (kg.)</th>
                                    <th class="p-3 border">สถานะ</th>
                                    <th class="p-3 text-center border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesPlans as $salesPlan)
                                <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                    <td class="p-2 text-center border min-w-[60px] max-w-[60px] truncate">{{
                                        \Carbon\Carbon::parse($salesPlan->SOPDate)->locale('th')->translatedFormat('d/m/Y')
                                        }}</td>
                                    <td class="p-2 text-center border min-w-[60px] max-w-[80px] truncate">
                                        {{ $salesPlan->GoodName }}
                                    </td>

                                    <td class="p-2 pl-4 border min-w-[80px] max-w-[80px] truncate">
                                        {{ $salesPlan->NumberCar }}
                                    </td>

                                    <td class="p-2 pl-4 border min-w-[60px] max-w-[150px] truncate">
                                        {{ $salesPlan->emCust->CustName }}
                                    </td>

                                    <td class="p-2 pr-4 font-bold border text-end">
                                        {{ isset($salesPlan->NetWei) ? number_format($salesPlan->NetWei, 0, '.', ',') :
                                        '-' }}
                                    </td>

                                    <td class="p-2 text-center border">
                                        @if($salesPlan->Status == 'F')
                                        <span  class="px-3 py-1 text-white rounded-full btn bg-success min-w-[100px] max-w-[100px]">Finish</span>
                                        @elseif($salesPlan->Status == 'W')
                                        <button type="button" class="px-3 py-1 border rounded-full btn border-warning text-warning hover:bg-warning hover:text-white min-w-[100px] max-w-[100px]" wire:click='cancel({{ $salesPlan->SOPID }})'>Warning</button>
                                        @elseif($salesPlan->Status == 'P')
                                        <span  class="px-3 py-1 text-white rounded-full btn bg-blue-400 min-w-[100px] max-w-[100px]">Processing</span>
                                        @elseif($salesPlan->Status == 'C')
                                        <span  class="px-3 py-1 text-white rounded-full btn bg-danger min-w-[100px] max-w-[100px]" >Cancel</span>
                                        @endif
                                    </td>

                                    <td class="p-2 text-center border min-w-[30px] max-w-[40px]">
                                        @if ($salesPlan->Status == 'W')
                                        <a href="#" wire:click='confirmEdit({{ $salesPlan->SOPID  }})'>
                                            <i class="me-4 fa-regular fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @can('delete IT')
                                        <a href="#" wire:click='confirmDelete({{ $salesPlan->SOPID }})'>
                                            <i class="fa-regular fa-trash-can text-danger hover:text-red-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @endcan
                                        @endif
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
            </div>



            <!-- Model ADD  -->
            <x-modal title="แผนการโหลดสินค้า" wire:model="showModal" maxWidth="2xl" zIndex="20" closeModal="closeModal">

                <form wire:submit.prevent="{{ $edit ? 'updateSalesPlan' : 'saveSalesPlan' }}" id="formAddSalesPlan">
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="SOPDate"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                วันที่รับสินค้า
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-calendar-day"></i>
                                </div>
                                <input type="date" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="SOPDate" name="SOPDate" wire:model="SOPDate" required />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="GoodID"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ชื่อสินค้า
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-gift"></i>
                                </div>
                                <select type="text"
                                    class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="GoodID" name="GoodID" wire:model="GoodID" required>
                                    <option selected value="">เลือก...</option>
                                    @foreach ($emGoods as $emGood)
                                    <option value="{{$emGood->GoodID}}">{{$emGood->GoodCode}} {{$emGood->GoodName1}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('GoodID'))
                            <span class="text-sm text-red-500">{{ $errors->first('GoodID') }}</span>
                            @endif
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
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="AmntLoad" name="AmntLoad" wire:model="AmntLoad" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                        <div class="">
                            <label for="CustID"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ชื่อคู่ค้า
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <select type="text"
                                    class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="CustID" name="CustID" wire:model="CustID" required>
                                    <option selected value="">เลือก...</option>
                                    @foreach ($emCusts as $emCust)
                                    <option value="{{$emCust->CustID}}">{{$emCust->CustName}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('CustID'))
                            <span class="text-sm text-red-500">{{ $errors->first('CustID') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
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
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Recipient" name="Recipient" wire:model.lazy="Recipient" list="Recipients" />
                                <datalist id="Recipients">
                                    @foreach($recipients as $recipient)
                                    <option value="{{ $recipient }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                    </div>

                    @if($edit)
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
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="NumberCar" name="NumberCar" wire:model="NumberCar" required list="NumberCars" />
                                <datalist id="NumberCars">
                                    @foreach($carPlates as $plate)
                                    <option value="{{ $plate }}"></option>
                                    @endforeach
                                </datalist>
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
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500 me-2"
                                    id="DriverName" name="DriverName" wire:model="DriverName" list="DriverNames" />
                                <datalist id="DriverNames">
                                    @foreach($driveNames as $driveName)
                                    <option value="{{ $driveName }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        @foreach($drivers as $index => $driver)
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
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="NumberCar" name="NumberCar" wire:model="drivers.{{ $loop->index }}.NumberCar"
                                    required list="NumberCars" />
                                <datalist id="NumberCars">
                                    @foreach($carPlates as $plate)
                                    <option value="{{ $plate }}"></option>
                                    @endforeach
                                </datalist>
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
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500 me-2"
                                    id="DriverName" name="DriverName" wire:model.lazy="drivers.{{ $index }}.DriverName"
                                    list="DriverNames" />
                                <datalist id="DriverNames">
                                    @foreach($driveNames as $driveName)
                                    <option value="{{ $driveName }}"></option>
                                    @endforeach
                                </datalist>
                                <button type="button" wire:click="removeDriver({{ $index }})"
                                    class="text-xl text-red-500 rounded-md hover:text-red-900"> <i
                                        class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        <button type="button" wire:click="addDriver"
                            class="px-4 py-2 mt-2 font-semibold text-white bg-green-500 rounded hover:bg-green-600">
                            + เพิ่มทะเบียนรถและคนขับ
                        </button>
                    </div>
                    @endif


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
