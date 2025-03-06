<div>
    {{-- @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายผลิตและวิศวกรรม', 'title' => 'รายงานการผลิต']) --}}

    <div class="grid grid-cols-1 mt-8 lg:grid-cols-3">

        <!-- Card 1 -->
        <div class="flex justify-center">
            <label for="selectedDate"
                class="items-center inline-block mt-2 text-sm font-medium text-default-800 me-2 font-anuphan">เลือกวันที่</label>
            <div class="md:col-span-3">
                <input
                    class="font-semibold text-blue-900 rounded-lg form-input focus:ring-blue-500 focus:border-blue-500"
                    type="date" id="selectedDate" wire:model="selectedDate" wire:change="changeDate">
            </div>
        </div>

        <!-- Card 2 -->
        <div class="w-full p-1 mx-auto overflow-hidden card">


            <div class="text-center">

                    <div class="p-6 text-xl font-semibold text-center text-white bg-green-600 rounded-t-lg font-prompt">
                        รายงานการผลิต วันที่ {{
                            \Carbon\Carbon::parse($Date)->locale('th')->translatedFormat('d F Y')
                            }}</td>
                    </div>
                    <div class="flex justify-around py-4 bg-green-100 border-t border-dashed border-default-200">
                        <div class="text-center">
                            <p class="text-2xl font-medium font-bold text-default-800">{{ $FFBForward}}<span class="text-sm font-anuphan"> ตัน</span></p>
                            <p class="text-sm text-default-500 font-anuphan">ยอดยกมา</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-medium font-bold text-default-800">{{ $FFBPurchase}}<span class="text-sm font-anuphan"> ตัน</span</p>
                            <p class="text-sm text-default-500 font-anuphan">ผลปาล์มรับเข้า</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-medium font-bold text-default-800">{{ $TotalFFB}}<span class="text-sm font-anuphan"> ตัน</span</p>
                            <p class="text-sm text-default-500 font-anuphan">ยอดรวมผลปาล์ม</p>
                        </div>
                    </div>
                    <table class="w-full border border-collapse border-gray-200 font-prompt">
                        <tbody>
                            <tr class="bg-red-100 border-gray-300 ">
                                <th class="p-3 text-left min-w-[180px] max-w-[180px]">ผลปาล์มเข้าผลิต</th>
                                <th class="p-2 text-right">จำนวน</th>
                                <th class="p-2 text-center"></th>
                                <th class="p-2 text-right">ปริมาณ</th>
                                <th class="p-2 text-center"></th>
                            </tr>
                            <tr class="bg-blue-100 border-gray-300 border-y">
                                <td class="p-2 text-left text-default-800">กะ A</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $ShiftA }}</td>
                                <td class="p-2 text-left font-anuphan">กะบะ</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $tonShiftA }}</td>
                                <td class="p-2 text-left font-anuphan">ตัน</td>
                            </tr>
                            <tr class="bg-blue-100 border-gray-300 border-y">
                                <td class="p-2 text-left text-default-800">กะ B</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $ShiftB }}</td>
                                <td class="p-2 text-left font-anuphan">กะบะ</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $tonShiftB }}</td>
                                <td class="p-2 text-left font-anuphan">ตัน</td>
                            </tr>
                            <tr class="bg-blue-100 border-gray-300 border-y">
                                <td class="p-2 text-left text-default-800">กะ 3</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $Shift3 }}</td>
                                <td class="p-2 text-left font-anuphan">กะบะ</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $tonShift3 }}</td>
                                <td class="p-2 text-left font-anuphan">ตัน</td>
                            </tr>
                            <tr class="bg-blue-100 border border-gray-200 border-y">
                                <td class="p-2 text-left text-default-800">ผลรวมการผลิต</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{$sumShiftPikUp}}</td>
                                <td class="p-2 text-left font-anuphan">กะบะ</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $FFBGoodQty}}</td>
                                <td class="p-2 text-left font-anuphan">ตัน</td>
                            </tr>
                            <tr class="bg-yellow-100 border-gray-200 border-y">
                                <th class="p-3 text-center text-default-800">ผลปาล์มคงค้าง</th>
                                <th class="p-2 text-right"></th>
                                <th class="p-2 font-bold text-center text-red-600" colspan="3">(ค่าเฉลี่ย {{$AvgPikup}}  ตัน/กะบะ)</th>
                            </tr>
                            <tr class="bg-yellow-100 border-gray-200 border-y">
                                <td class="p-2 text-left text-default-800">อบ</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $Steam }}</td>
                                <td class="p-2 text-left font-anuphan">กะบะ</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800" rowspan="2">{{ number_format($sumPikUpRemain, 2)}}</td>
                                <td class="p-2 text-left font-anuphan" rowspan="2">ตัน</td>
                            </tr>
                            <tr class="bg-yellow-100 border-gray-200 border-y">
                                <td class="p-2 text-left text-default-800">บรรจุ</td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">{{ $StuckIn }}</td>
                                <td class="p-2 text-left font-anuphan">กะบะ</td>

                            </tr>
                            <tr class="bg-yellow-100 border-gray-200 border-y">
                                <td class="p-2 text-left text-default-800">ลานเท</td>
                                <td class="p-2 text-right"></td>
                                <td class="p-2 text-left"></td>
                                <td class="p-2 text-lg font-bold text-right text-default-800">
                                    {{ $RamRemain2 }}
                                </td>
                                <td class="p-2 text-left font-anuphan">ตัน</td>
                            </tr>
                            <tr class="text-red-500 bg-yellow-100 border-gray-200 text-md border-y">
                                <td class="p-3 text-left">รวมปาล์มคงค้าง</td>
                                <td class="p-2 text-right"></td>
                                <td class="p-2 text-left"></td>
                                <td class="p-2 text-lg font-bold text-right text-red-600">{{ $FFBRemain }}</td>
                                <td class="p-2 text-left font-anuphan">ตัน</td>
                            </tr>


                        </tbody>
                    </table>
            </div>
            <div class="flex justify-around py-4 border-t border-dashed bg-default-50 border-default-200">
                <div class="text-center">
                    <p class="text-lg font-medium text-default-800">{{$RawFFB}}<span class="text-sm font-anuphan"> ตัน</span></p>

                    <p class="text-sm text-default-500 font-anuphan">ปาล์มดิบ</p>
                </div>
                <div class="text-center">
                    <p class="text-lg font-medium text-default-800">{{$CS1}}<span class="text-sm"> cm.</span></p>
                    <p class="font-medium text-md text-default-800">{{$CS1 * 0.1689}} <span class="text-sm font-anuphan"> ตัน</span></p>
                    <p class="text-sm text-default-500 font-anuphan">CS 1</p>
                </div>
                <div class="text-center">
                    <p class="text-lg font-medium text-default-800">{{$CS2}} <span class="text-sm"> cm.</span> </p>
                    <p class="font-medium text-md text-default-800">{{$CS2 * 0.1689}} <span class="text-sm font-anuphan"> ตัน</span></p>
                    <p class="text-sm text-default-500 font-anuphan">CS 2</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="">

        </div>



    </div>

</div>
