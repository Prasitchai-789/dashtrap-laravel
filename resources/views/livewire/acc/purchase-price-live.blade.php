<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายบัญชีและการเงิน', 'title' => 'บันทึกราคารับซื้อ'])

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

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                    <h5 class="truncate card-title font-prompt">ราคาเฉลี่ย</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">{{ number_format($AvgPrice, 2, '.', ',') }}
                        <span class="text-sm"> บาท/kg.</span>
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
                        class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                    <h5 class="truncate card-title font-prompt">ยอดเงิน</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">{{ number_format($totalAmnt2OfDate, 3, '.', ',') }}
                        <span class="text-sm"> MB.</span>
                    </h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">{{ number_format($progressMaxPrice2, 0) }}%</span>
                        @if ($progressMaxPrice2 > 91)
                        <i class="fa-solid fa-arrow-down text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-up text-danger ms-2"></i>
                        @endif
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-warning" role="progressbar"
                        aria-valuenow="{{ $progressMaxPrice2 }}" aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $progressMaxPrice2 }}%;">
                    </div>
                </div>
            </div>
            <!--end card body-->
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
                            type="date" id="selectedDate" wire:model="selectedDate" wire:change="setDate">
                    </div>
                </div>
            </div>
            <div class="card-header">
                <!-- Table -->
                <div class="overflow-x-auto rounded-lg">
                    <div class=" font-anuphan">
                        <table class="w-full border border-collapse ">
                            <thead class="text-center bg-gray-200">
                                <tr class="border">
                                    <th class="p-3 border">ลำดับ</th>
                                    <th class="p-3 border">วันที่</th>
                                    <th class="p-3 border">รหัสบิล</th>
                                    <th class="p-3 border">ชื่อลูกค้า</th>
                                    <th class="p-3 border">ทะเบียนรถ</th>
                                    <th class="p-3 border">เข้า</th>
                                    <th class="p-3 border">ออก</th>
                                    <th class="p-3 border">สุทธิ</th>
                                    <th class="p-3 border">ราคา</th>
                                    <th class="p-3 border">ยอดเงิน</th>
                                    <th class="p-3 border">ประเภทบิล</th>
                                    <th class="p-3 text-center border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($webappPOInvs as $webappPOInv)
                                <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                    <td class="p-3 text-center border">{{ ($webappPOInvs->firstItem() + $loop->index) }}
                                    </td>
                                    <td class="p-3 border">{{
                                        \Carbon\Carbon::parse($webappPOInv->DocuDate)->locale('th')->translatedFormat('d/m/Y')
                                        }}</td>
                                    <td class="p-3 border">{{$webappPOInv->BillID}}</td>
                                    <td class="p-3 border">
                                        {{ optional($webappPOInv->empVendor)->VendorTitle ?
                                        optional($webappPOInv->empVendor)->VendorTitle .
                                        optional($webappPOInv->empVendor)->VendorName :
                                        optional($webappPOInv->empVendor)->VendorName }}
                                    </td>
                                    <td class="p-3 border">{{$webappPOInv->VendorCarID}}</td>
                                    <td class="p-3 border text-end">{{ number_format($webappPOInv->GoodIB, 0, '.', ',') }}
                                    </td>
                                    <td class="p-3 border text-end">{{ number_format($webappPOInv->GoodOB, 0, '.', ',') }}
                                    </td>
                                    <td class="p-3 font-bold border text-end">{{ number_format($webappPOInv->GoodNet, 0,
                                        '.', ',') }}</td>
                                    <td class="p-3 text-center border">{{
                                        number_format($webappPOInv->Price2, 2,
                                        '.', ',') }}</td>
                                    <td class="p-3 font-bold text-blue-800 border text-end">{{
                                        number_format($webappPOInv->Amnt2, 2,
                                        '.', ',') }}</td>
                                    <td class="p-3 text-center border">
                                        @if($webappPOInv->DocuType == 309)
                                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                            <span class="w-1.5 h-1.5 inline-block bg-pink-400 rounded-full"></span>
                                            ซื้อเชื่อ
                                        </span>
                                        @elseif($webappPOInv->DocuType == 312)
                                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                                            ซื้อสด
                                        </span>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td
                                        class="p-2 text-center border  min-w-[100px] max-w-[100px] relative">
                                        <a href="#" wire:click='confirmEdit({{ $webappPOInv->POInvID  }})'>
                                            <i class="me-4 fa-regular fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Table -->
                <div class="flex mt-4">
                    {{ $webappPOInvs->links('pagination::tailwind') ?? '' }}
                </div>

            </div>

        </div>
        <!-- Model ADD Palm -->
        <x-modal title="ข้อมูลการรับซื้อ" wire:model="showModal" maxWidth="2xl" zIndex="20" closeModal="closeModal">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updatePurchasePrice' : 'savePurchasePrice' }}"
                id="formPurchasePrice">
                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="BillID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เลขที่บิล
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="BillID" name="BillID" wire:model="BillID" readonly />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-2 font-anuphan">

                    <div>
                        <label for="VendorName"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ชื่อลูกค้า
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <input type="text" id="VendorName" name="VendorName" wire:model="VendorName"
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                readonly />
                        </div>
                    </div>
                    <div class="">
                        <label for="VendorCarID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ทะเบียนรถ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <input type="text" id="VendorCarID" name="VendorCarID" wire:model="VendorCarID"
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                readonly />
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="GoodNet"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            น้ำหนักสุทธิ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-cart-plus"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="GoodNet" name="GoodNet" wire:model="GoodNet" readonly />
                        </div>
                    </div>

                    <div class="">
                        <label for="Price2"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ราคา
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-money-bill"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Price2" name="Price2" wire:model="Price2" required />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="Amnt2"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ยอดเงิน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Amnt2" name="Amnt2" wire:model="Amnt2" readonly />
                        </div>
                    </div>
                    <div class="">
                        <label for="DocuType"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ประเภทบิล
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-inbox"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="DocuType" name="DocuType" wire:model="DocuType" required>
                                <option selected value="">เลือก...</option>
                                <option value="312">ซื้อสด</option>
                                <option value="309">ซื้อเชื่อ</option>
                            </select>
                        </div>
                    </div>
                </div>




                <div class="flex items-center justify-end px-4 py-3 mt-6 border-t gap-x-2 border-default-200">
                    <button type="submit" class="text-white btn bg-primary {{ $edit ? ' bg-warning' : ' bg-primary' }}"
                        href="#">
                        {{ $edit ? ' Update' : ' Save' }}
                    </button>
                </div>
            </form>
        </x-modal>
        <!-- End Model ADD Palm -->
    </div>
</div>

