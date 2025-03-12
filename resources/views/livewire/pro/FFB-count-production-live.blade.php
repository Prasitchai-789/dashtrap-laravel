<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายผลิตและวิศวกรรม', 'title' => 'บันทึกการผลิต'])

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
                                    <th class="p-3 border">ส่วนงาน</th>
                                    <th class="p-3 border">เริ่มงาน</th>
                                    <th class="p-3 border">เลิกงาน</th>
                                    <th class="p-3 border">จำนวนการผลิต (กะบะ)</th>
                                    <th class="p-3 border">ยอดยกไป (กะบะ)</th>
                                    <th class="p-3 border">Flow Meter</th>
                                    <th class="p-3 text-center border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ffbCountProductions as $ffbCountProduction)
                                <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                    <td class="p-2 text-center border min-w-[80px] max-w-[80px] truncate">{{
                                        \Carbon\Carbon::parse($ffbCountProduction->Date)->locale('th')->translatedFormat('d/m/Y')
                                        }}</td>
                                    <td class="p-2 text-center border min-w-[60px] max-w-[80px] truncate">

                                        @if ( $ffbCountProduction->Shift == "A")
                                        <span
                                            class="inline-flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-full text-xs font-medium bg-pink-100 text-pink-800 min-w-[60px] max-w-[60px] font-bold">
                                            <span class="w-1.5 h-1.5 inline-block bg-pink-400 rounded-full"></span>
                                            กะ A
                                        </span>
                                        @else
                                        <span
                                            class="inline-flex items-center justify-center gap-1.5 py-1.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 min-w-[60px] max-w-[60px] font-bold">
                                            <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                                            กะ B
                                        </span>
                                        @endif
                                    </td>

                                    <td class="p-2 text-center border min-w-[100px] max-w-[100px] truncate">{{
                                        \Carbon\Carbon::parse($ffbCountProduction->StartTime)->locale('th')->translatedFormat('H:i')
                                        }} น.</td>

                                    <td class="p-2 text-center border min-w-[100px] max-w-[100px] truncate">{{
                                        \Carbon\Carbon::parse($ffbCountProduction->FinishTime)->locale('th')->translatedFormat('H:i')
                                        }} น.</td>
                                    <td class="p-2 pl-4 font-bold text-center text-blue-500 border">
                                        {{ $ffbCountProduction->Quantity == 0 ? "-" : $ffbCountProduction->Quantity}}
                                    </td>
                                    <td class="p-2 pl-4 text-center border">
                                        {{ $ffbCountProduction->PikupForward ==0 ? "-" :
                                        $ffbCountProduction->PikupForward}}
                                    </td>
                                    <td class="p-2 pl-4 border min-w-[80px] max-w-[80px] truncate text-end">
                                        {{ $ffbCountProduction->Amount ==0 ? "-" :
                                        number_format($ffbCountProduction->Amount,2) }}
                                    </td>


                                    <td class="p-2 text-center border">
                                        <a href="javascript:void(0)"
                                            wire:click='confirmEdit({{ $ffbCountProduction->id  }})'>
                                            <i class="me-4 fa-regular fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @can('delete IT')
                                        <a href="javascript:void(0)"
                                            wire:click='confirmDelete({{ $ffbCountProduction->id }})'>
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
                            {{ $ffbCountProductions->links('vendor.livewire.custom-pagination') }}
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>



            <!-- Model ADD  -->
            <x-modal title="แผนการโหลดสินค้า" wire:model="showModal" maxWidth="2xl" zIndex="20" closeModal="closeModal"
                bg="bg-success">

                <form wire:submit.prevent="{{ $edit ? 'updateFFBCount' : 'saveFFBCount' }}" id="formAddFFBCount"
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
                                    id="Date" name="Date" wire:model="Date" required />
                            </div>
                        </div>
                    </div>

                    <hr class="mx-4 mt-6 mb-2 border-blue-200 border-dashed border-t-1">
                    <h1 class="ml-4 text-lg font-bold text-blue-800 font-anuphan">ข้อมูลการผลิต</h1>
                    <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="Shift"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ส่วนงาน</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-clipboard-user dark:text-gray-400"></i>
                                </span>
                                <select type="text"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    id="Shift" name="Shift" wire:model="Shift" required>
                                    <option selected value="">เลือก...</option>
                                    <option value="A">กะ A</option>
                                    <option value="B">กะ B</option>
                                </select>
                            </div>
                            @if ($errors->has('Shift'))
                            <span class="text-sm text-red-500">{{ $errors->first('Shift') }}</span>
                            @endif
                        </div>

                        <div>
                            <label for="Quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนที่ผลิตได้
                                (กะบะ)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="Quantity" name="Quantity" wire:model="Quantity"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="จำนวนที่ผลิตได้">
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-2 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div>
                            <label for="StartTime"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เริ่มงาน</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="time" id="StartTime" name="StartTime" wire:model="StartTime"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="">
                            </div>
                        </div>

                        <div>
                            <label for="FinishTime"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เลิกงาน</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="time" id="FinishTime" name="FinishTime" wire:model="FinishTime"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="">
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-2 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div>
                            <label for="DatePalm1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ผลปาล์มวันที่</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="date" id="DatePalm1" name="DatePalm1" wire:model="DatePalm1"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="">
                            </div>
                        </div>

                        <div>
                            <label for="Contain1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">บรรจุ
                                (กะบะ)</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="text" id="Contain1" name="Contain1" wire:model="Contain1"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="กะบะ">

                                <button type="button" wire:click="increment"
                                    class="ml-2 text-xl text-white rounded-md hover:text-red-900"> <i
                                        class="p-1.5 text-sm rounded-full fa-solid fa-plus bg-primary"></i>
                                </button>
                            </div>

                        </div>

                    </div>
                    <div class="grid grid-cols-2 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        @for ($i = 2; $i < $numberOfInputs; $i++) <div>
                            <label for="DatePalm{{ $i }}"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ผลปาล์มวันที่</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                    <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                                </span>
                                <input type="date" id="DatePalm{{ $i }}" name="DatePalm{{ $i }}"
                                    wire:model.defer="DatePalm{{ $i }}"
                                    class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                    placeholder="">
                            </div>
                    </div>

                    <div>
                        <label for="Contain{{ $i }}"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">บรรจุ
                            (กะบะ)</label>
                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                                <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                            </span>
                            <input type="text" id="Contain{{ $i }}" name="Contain{{ $i }}" wire:model="Contain{{ $i }}"
                                class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                                placeholder="กะบะ">

                            <button type="button" wire:click="decrement"
                                class="ml-2 text-xl text-white rounded-md hover:text-red-900"> <i
                                    class="p-1.5 text-sm rounded-full fa-solid fa-minus bg-red-500"></i>
                            </button>
                        </div>

                    </div>

                    @endfor
        </div>

        <div class="grid grid-cols-2 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
            <div>
                <label for="PikupForward"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ยอดยกไป</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                        <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                    </span>
                    <input type="text" id="PikupForward" name="PikupForward" wire:model="PikupForward"
                        class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                        placeholder="กะบะ">
                </div>
            </div>

            <div>
                <label for="RawFFB"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ปาล์มดิบ</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                        <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                    </span>
                    <input type="text" id="RawFFB" name="RawFFB" wire:model="RawFFB"
                        class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                        placeholder="กะบะ">
                </div>
            </div>

        </div>

        <hr class="mx-4 mt-6 mb-2 border-blue-200 border-dashed border-t-1">
        <h1 class="ml-4 text-lg font-bold text-blue-800 font-anuphan">ข้อมูลน้ำมัน</h1>
        <div class="grid grid-cols-2 gap-4 m-4 mt-1 mb-3 md:grid-cols-2 font-anuphan">
            <div>
                <label for="CS1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CS 1</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                        <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                    </span>
                    <input type="text" id="CS1" name="CS1" wire:model="CS1"
                        class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                        placeholder="cm.">
                </div>
            </div>

            <div>
                <label for="CS2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CS 2</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                        <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                    </span>
                    <input type="text" id="CS2" name="CS2" wire:model="CS2"
                        class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                        placeholder="cm.">
                </div>
            </div>

        </div>
        <div class="grid grid-cols-2 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
            <div>
                <label for="FlowMeterBefore" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Flow
                    Meter
                    ก่อน</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                        <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                    </span>
                    <input type="text" id="FlowMeterBefore" name="FlowMeterBefore" wire:model.lazy="FlowMeterBefore"
                        class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                        placeholder="0.00">
                </div>
            </div>

            <div>
                <label for="FlowMeterAfter" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Flow
                    Meter
                    หลัง</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md">
                        <i class="w-4 h-4 text-gray-500 fa-solid fa-circle-user"></i>
                    </span>
                    <input type="text" id="FlowMeterAfter" name="FlowMeterAfter" wire:model.lazy="FlowMeterAfter"
                        class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5"
                        placeholder="0.00">
                </div>
            </div>

        </div>
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
