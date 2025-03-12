<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายผลิตและวิศวกรรม', 'title' => 'รายงานการผลิต'])

    <div class="page-header">
        <div class="page-header">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-between mb-2">
                    <!-- ส่วนของปุ่มต่างๆ -->
                    <button type="button"
                        class="px-4 py-2 text-sm font-bold text-white transition rounded-lg bg-primary hover:bg-blue-500 hover:shadow-lg hover:scale-105"
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
                                    <th class="p-3 border">สถานะ</th>
                                    <th class="p-3 border">ยอดยกมา</th>
                                    <th class="p-3 border">ยอดรับเข้า</th>
                                    <th class="p-3 border">ปริมาณรวมผลปาล์ม (ตัน)</th>
                                    <th class="p-3 border">กะ A (กะบะ)</th>
                                    <th class="p-3 border">กะ B (กะบะ)</th>
                                    <th class="p-3 border">กะ 3 (กะบะ)</th>
                                    <th class="p-3 border">ปริมาณการผลิต (ตัน)</th>
                                    <th class="p-3 border">ค่าเฉลี่ย/กะบะ</th>
                                    <th class="p-3 border">อบ (กะบะ)</th>
                                    <th class="p-3 border">บรรจุ (กะบะ)</th>
                                    <th class="p-3 border">ลานเท (ตัน)</th>
                                    <th class="p-3 border">รวมปาล์มคงค้าง</th>
                                    <th class="p-3 text-center border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productions as $production)
                                <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                    <td class="p-2 text-center border min-w-[100px] max-w-[100px] truncate">{{
                                        \Carbon\Carbon::parse($production->Date)->locale('th')->translatedFormat('d/m/Y')
                                        }}</td>
                                    <td class="p-2 text-center border min-w-[60px] max-w-[80px] truncate">
                                        @if ( $production->FFBGoodQty == 0)
                                        <span
                                            class="inline-flex items-center gap-1.5 py-1.5 px-2 rounded-full text-xs font-medium bg-pink-100 text-pink-800 min-w-[60px] max-w-[60px]">
                                            <span class="w-1.5 h-1.5 inline-block bg-pink-400 rounded-full"></span>
                                            ไม่ผลิต
                                        </span>
                                        @elseif ( $production->FFBGoodQty > 1)
                                        <span
                                            class="inline-flex items-center gap-1.5 py-1.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 min-w-[60px] max-w-[60px]">
                                            <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                                            ผลิต
                                        </span>
                                        @endif
                                    </td>

                                    <td class="p-2 text-end border min-w-[90px] max-w-[90px] truncate">
                                        {{ $production->FFBForward == 0 ? "-" :
                                        number_format($production->FFBForward,2)}}
                                    </td>

                                    <td class="p-2 text-center border min-w-[90px] max-w-[90px] truncate font-bold">
                                        {{ $production->FFBPurchase == 0 ? "-" :
                                        number_format($production->FFBPurchase,2)}}
                                    </td>
                                    <td
                                        class="p-2 text-end border min-w-[90px] max-w-[90px] truncate text-blue-500 font-bold">
                                        {{ $production->TotalFFB == 0 ? "-" : number_format($production->TotalFFB,2)}}
                                    </td>
                                    <td class="p-2 text-center border min-w-[80px] max-w-[80px] truncate">
                                        {{ $production->ShiftA == 0 ? "-" : $production->ShiftA}}
                                    </td>
                                    <td class="p-2 text-center border min-w-[80px] max-w-[80px] truncate">
                                        {{ $production->ShiftB == 0 ? "-" : $production->ShiftB}}
                                    </td>
                                    <td class="p-2 text-center border min-w-[80px] max-w-[80px] truncate">
                                        {{ $production->Shift3 == 0 ? "-" : $production->Shift3}}
                                    </td>
                                    <td
                                        class="p-2 text-end border min-w-[80px] max-w-[80px] truncate text-green-500 font-bold">
                                        {{ $production->FFBGoodQty == 0 ? "-" :
                                        number_format($production->FFBGoodQty,2)}}
                                    </td>
                                    <td class="p-2 text-end border min-w-[80px] max-w-[80px] truncate">
                                        {{ $production->AvgPikup == 0 ? "-" :number_format($production->AvgPikup,2)}}
                                    </td>
                                    <td class="p-2 text-center border min-w-[80px] max-w-[80px] truncate">
                                        {{ $production->Steam == 0 ? "-" : $production->Steam}}
                                    </td>
                                    <td class="p-2 text-center border min-w-[80px] max-w-[80px] truncate">
                                        {{ $production->StuckIn == 0 ? "-" : $production->StuckIn}}
                                    </td>
                                    <td class="p-2 text-end border min-w-[80px] max-w-[80px] truncate">
                                        {{ $production->RamRemain2 == 0 ? "-" :
                                        number_format($production->RamRemain2,2)}}
                                    </td>
                                    <td
                                        class="p-2 text-end border min-w-[80px] max-w-[80px] truncate text-red-500 font-bold">
                                        {{ $production->FFBRemain == 0 ? "-" : number_format($production->FFBRemain,2)}}
                                    </td>

                                    <td class="p-2 text-center border">
                                        <a href="javascript:void(0)" wire:click='confirmEdit({{ $production->id  }})'>
                                            <i class="me-4 fa-regular fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @can('delete IT')
                                        <a href="javascript:void(0)" wire:click='confirmDelete({{ $production->id }})'>
                                            <i class="fa-regular fa-trash-can text-danger hover:text-red-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @endcan
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex mt-4">
                            {{ $productions->links('vendor.livewire.custom-pagination') }}
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>



            <!-- Model ADD  -->
            <x-modal title="บันทึกการผลิต" wire:model="showModal" maxWidth="2xl" zIndex="20" closeModal="closeModal"
                bg="bg-success">

                <form wire:submit.prevent="{{ $edit ? 'updateProduction' : 'saveProduction' }}" id="formAddProduction"
                    method="POST">
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="Date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                วันที่ผลิต
                            </label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-calendar-day dark:text-gray-400"></i>
                                </span>

                                <input type="date" placeholder=""
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    id="Date" name="Date" wire:model="Date" wire:change='changeDate' required />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 m-4 mb-5 md:grid-cols-1 font-prompt">
                            <div class="flex items-center mt-5">
                                <input class="form-switch" type="checkbox" role="switch" id="use_check"
                                    wire:model.live="use_check"  {{ $use_check ? 'checked' : '' }}>
                                <label class=" ms-1.5" for="use_check">
                                ผลิต
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="mx-4 mt-4 mb-2 border-blue-200 border-dashed border-t-1">
                    <h1 class="ml-4 text-lg font-bold text-blue-800 font-anuphan">ปริมาณผลปาล์ม</h1>
                    <div class="grid grid-cols-1 gap-4 m-4 mt-1 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="FFBForward"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ยอดยกมา</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-regular fa-share-from-square"></i>
                                </span>
                                <input type="text" id="FFBForward" name="FFBForward" wire:model="FFBForward"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="ยอดยกมา">
                            </div>
                            @if ($errors->has('FFBForward'))
                            <span class="text-sm text-red-500">{{ $errors->first('FFBForward') }}</span>
                            @endif
                        </div>

                        <div>
                            <label for="FFBPurchase"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ยอดรับเข้า</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-cart-shopping"></i>
                                </span>
                                <input type="text" id="FFBPurchase" name="FFBPurchase" wire:model="FFBPurchase"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="ยอดรับเข้า">
                            </div>
                        </div>

                    </div>

                    <hr class="mx-4 mt-6 mb-2 border-blue-200 border-dashed border-t-1">
                    <h1 class="ml-4 text-lg font-bold text-blue-800 font-anuphan">ข้อมูลการผลิต</h1>
                    @if ($use_check == 1)
                    <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols-3 font-anuphan">
                        <div>
                            <label for="ShiftA" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">กะ A</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="ShiftA" name="ShiftA" wire:model="ShiftA" wire:change="sumFFBGoodQty"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="กะบะ">
                            </div>
                        </div>

                        <div>
                            <label for="ShiftB" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">กะ B</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md dark:bg-gray-600">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="ShiftB" name="ShiftB" wire:model="ShiftB" wire:change="sumFFBGoodQty"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="กะบะ">
                            </div>
                        </div>
                        <div>
                            <label for="Shift3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">กะ 3</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="Shift3" name="Shift3" wire:model="Shift3" wire:change="sumFFBGoodQty"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.500"
                                    placeholder="กะบะ">
                            </div>
                        </div>

                    </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols- font-anuphan">
                        <div>
                            <label for="PikupRemain" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ค้างกะบะ</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-inbox"></i>
                                </span>
                                <input type="text" id="PikupRemain" name="PikupRemain" wire:model="PikupRemain" wire:change="sumFFBGoodQty"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="กะบะ">
                            </div>
                        </div>

                        <div>
                            <label for="RamRemain" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">คาดการณ์บนลาน</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="RamRemain" name="RamRemain" wire:model="RamRemain" wire:change="sumFFBGoodQty"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="กะบะ">
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols- font-anuphan">
                        <div>
                            <label for="AvgPikup" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ค่าเฉลี่ย/กะบะ (ตัน)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-gauge"></i>
                                </span>
                                <input type="text" id="AvgPikup" name="AvgPikup" wire:model="AvgPikup"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-blue-600 font-bold focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="" readonly>
                            </div>
                        </div>

                        <div>
                            <label for="FFBGoodQty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ปริมาณการผลิต (ตัน)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-industry"></i>
                                </span>
                                <input type="text" id="FFBGoodQty" name="FFBGoodQty" wire:model="FFBGoodQty"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-blue-600 font-bold focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols- font-anuphan">
                        <div>
                            <label for="Steam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อบ</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-teeth-open"></i>
                                </span>
                                <input type="text" id="Steam" name="Steam" wire:model="Steam" wire:change="sumFFBRemain"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="กะบะ">
                            </div>
                        </div>

                        <div>
                            <label for="StuckIn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">บรรจุ</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-inbox"></i>
                                </span>
                                <input type="text" id="StuckIn" name="StuckIn" wire:model="StuckIn" wire:change="sumFFBRemain"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="กะบะ">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols- font-anuphan">
                        <div>
                            <label for="RawFFB" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ปาล์มดิบ</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-hand"></i>
                                </span>
                                <input type="text" id="RawFFB" name="RawFFB" wire:model="RawFFB"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="ตัน">
                            </div>
                        </div>

                        <div>
                            <label for="FFBRemain" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ปาล์มคงค้าง</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-layer-group"></i>
                                </span>
                                <input type="text" id="FFBRemain" name="FFBRemain" wire:model="FFBRemain"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-blue-600 font-bold focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="" readonly>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols- font-anuphan">
                        <div>
                            <label for="CS1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CS 1</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="CS1" name="CS1" wire:model="CS1"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-100 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="cm.">
                            </div>
                        </div>

                        <div>
                            <label for="CS2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CS 2</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="CS2" name="CS2" wire:model="CS2"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-100 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="cm.">
                            </div>
                        </div>
                    </div> --}}
                    <!-- ปุ่ม submit -->
                    <div class="flex items-center justify-end px-4 py-3 mt-6 border-t gap-x-2 border-default-200">
                        <button type="submit" class="text-white btn bg-success" href="#">
                            {{ $edit ? ' Update' : ' Save' }}
                        </button>
                    </div>
                </form>
            </x-modal>
            <!-- End Model ADD  -->

        </div>
    </div>
</div>
