<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายยานยนต์', 'title' => 'ข้อมูลรถยนต์'])

    <div class="card">
        <div class="mt-6">
            <div class="flex items-center justify-between">
                <!-- ส่วนของปุ่มต่างๆ -->

                <a href="{{ route('car-report') }}"
                    class="inline-flex items-center px-4 py-2 ml-8 text-sm font-bold text-white transition bg-red-500 rounded-lg hover:bg-red-700 font-anuphan">
                    <i class="fa-solid fa-chevron-left me-2"></i>
                    ย้อนกลับ
                </a>

                <h5 class="text-2xl text-center card-title font-prompt">ข้อมูลรถยนต์</h5>
                <button type="button"
                    class="px-4 py-2 mr-8 text-sm font-bold text-white transition rounded-lg bg-primary hover:bg-blue-500 font-anuphan"
                    wire:click='openModalRepair'>
                    เพิ่มข้อมูล
                </button>
            </div>

        </div>
        <div class="grid gap-5 mb-5 xl:grid-cols-2 md:grid-cols-2">

            <div class="flex items-center justify-center p-8">
                <div class=" card">
                    <img src="{{ asset('storage/' . $carReportList[0]->car_photo) }}" alt="Car Image" class="object-cover w-full h-80">

                </div>
            </div>

            <div class="xl:col-span-1">
                <div class="">

                    <div class="mt-6 card-body">
                        <table class="table text-start font_anuphan">
                            <tbody class="font-prompt">
                                <tr class="border-y">
                                    <td class="py-4 column1 h6" style="width: 100px">เลขทะเบียน</td>
                                    <td class="column2 min-w-[200px] max-w-[250px] truncate text-blue-700"> : {{
                                        $carReportList[0]->car_number }} {{
                                        $carReportList[0]->province->ProvinceName ?? 'N/A' }}</td>
                                    <td class="column1 h6" style="width: 100px">ประเภทรถ</td>
                                    <td class="text-blue-700 column2"> : {{ $carReportList[0]->type->car_type_list }}
                                    </td>
                                </tr>
                                <tr class="border-y">
                                    <td class="py-4 column1 h6">ลักษณะ</td>
                                    <td class="text-blue-700 column2"> : {{
                                        $carReportList[0]->character->car_character_list }}
                                    </td>
                                    <td class="column1 h6">ยี่ห้อ</td>
                                    <td class="text-blue-700 column2">: {{ $carReportList[0]->brand->car_brand_list }}
                                    </td>
                                </tr>
                                <tr class="border-y">
                                    <td class="py-4 column1 h6">รุ่น</td>
                                    <td class="text-blue-700 column2"> : {{ $carReportList[0]->car_model }}</td>
                                    <td class="column1 h6">สี </td>
                                    <td class="text-blue-700 column2"> : {{ $carReportList[0]->car_color }}</td>
                                </tr>
                                <tr class="border-y">
                                    <td class="py-4 column1 h6">ปีที่ผลิต</td>
                                    <td class="text-blue-700 column2"> : {{ $carReportList[0]->car_year }}</td>
                                    <td class="column1 h6">วันที่จดทะเบียน</td>
                                    <td class="text-blue-700 column2"> : </td>
                                </tr>
                                <tr class="border-y">
                                    <td class="py-4 column1 h6">ภาษี</td>
                                    <td class="column2"> :
                                        @php
                                        try {
                                            // แปลงวันที่จากฐานข้อมูล
                                            $date = \Carbon\Carbon::parse($carReportList[0]->car_tax);
                                        } catch (\Exception $e) {
                                            $date = null;
                                        }

                                        if ($date && $date->format('Y-m-d') !== '1900-01-01') {
                                            $formattedDate = $date->translatedFormat('j F Y');

                                            // กำหนดสีตามเงื่อนไข
                                            if ($date->lessThan($today)) {
                                                $color = 'red'; // 🔴 เลยกำหนด (วันหมดอายุ)
                                            } elseif ($date->lessThanOrEqualTo($sevenDaysLater)) {
                                                $color = 'orange'; // 🟡 ใกล้หมดอายุ (เหลือไม่เกิน 7 วัน)
                                            } else {
                                                $color = 'black'; // ✅ ปกติ
                                            }

                                            echo "<span style='color: {$color};'>{$formattedDate}</span>";
                                        } else {
                                            echo '❌ วันที่ไม่ถูกต้อง';
                                        }
                                        @endphp
                                    </td>

                                    <td class="column1 h6">ประกันภัย</td>
                                    <td class="column2"> :
                                         @php
                                         try {
                                             // แปลงวันที่จากฐานข้อมูล
                                             $date = \Carbon\Carbon::parse($carReportList[0]->car_insurance);
                                         } catch (\Exception $e) {
                                             $date = null;
                                         }

                                         if ($date && $date->format('Y-m-d') !== '1900-01-01') {
                                             $formattedDate = $date->translatedFormat('j F Y');

                                             // กำหนดสีตามเงื่อนไข
                                             if ($date->lessThan($today)) {
                                                 $color = 'red'; // 🔴 เลยกำหนด (วันหมดอายุ)
                                             } elseif ($date->lessThanOrEqualTo($sevenDaysLater)) {
                                                 $color = 'orange'; // 🟡 ใกล้หมดอายุ (เหลือไม่เกิน 7 วัน)
                                             } else {
                                                 $color = 'black'; // ✅ ปกติ
                                             }

                                             echo "<span style='color: {$color};'>{$formattedDate}</span>";
                                         } else {
                                             echo '❌ วันที่ไม่ถูกต้อง';
                                         }
                                         @endphp

                                    </td>
                                </tr>
                                <tr class="border-y">
                                    <td class="py-4 column1 h6">วันที่ซื้อ </td>
                                    <td class="column2"> :
                                        @php
                                        try {
                                            // แปลงวันที่จากฐานข้อมูล
                                            $date = \Carbon\Carbon::parse($carReportList[0]->car_buy);
                                        } catch (\Exception $e) {
                                            $date = null;
                                        }

                                        if ($date && $date->format('Y-m-d') !== '1900-01-01') {
                                            $formattedDate = $date->translatedFormat('j F Y');

                                            // กำหนดสีตามเงื่อนไข
                                            if ($date->lessThan($today)) {
                                                $color = 'black'; // ✅ ปกติ
                                            } else {

                                            }

                                            echo "<span style='color: {$color};'>{$formattedDate}</span>";
                                        } else {
                                            echo '❌ วันที่ไม่ถูกต้อง';
                                        }
                                        @endphp
                                    </td>
                                    <td class="column1 h6">เลขไมล์</td>
                                    <td class="text-blue-700 column2"> : {{ $carReportList[0]->car_mileage }}</td>
                                </tr>
                                <tr class="border-y">
                                    <td class="py-4 column1 h6">ส่วนงานที่ดูแล </td>
                                    <td class="text-blue-700 column2"> :
                                        {{ $carReportList[0]->department->DeptName ?? '-' }}
                                    </td>
                                    <td class="column1 h6">รายละเอียด </td>
                                    <td class="text-blue-700 column2"> :
                                        {{ $carReportList[0]->car_details }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="">
            <h5 class="text-2xl text-center card-title font-prompt">ประวัติการแจ้งซ่อม</h5>
        </div>
        <div>
            <div class="card-header">
                <!-- Table -->
                <div class="">
                    <div class="overflow-x-auto rounded-lg font-anuphan">
                        <table class="w-full border border-collapse">
                            <thead class="text-center bg-gray-200 ">
                                <tr class="font-prompt">
                                    <th class="p-4">
                                        วันที
                                    </th>
                                    <th>
                                        รายการ
                                    </th>
                                    <th>
                                        ซ่อมครั้งล่าสุด
                                    </th>
                                    <th class="min-w-[50px] max-w-[60px]">
                                        แผนการบำรุงรักษา
                                    </th>
                                    <th>
                                        รายละเอียด
                                    </th>
                                    <th>
                                        ผู้แจ้ง
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carRepairs as $carRepair)
                                <tr class="border font-anuphan hover:bg-gray-100 hover:text-blue-500">
                                    <td class="p-2.5 text-center min-w-[60px] max-w-[70px] truncate">
                                        {{
                                        \Carbon\Carbon::parse($carRepair->created_at)->locale('th')->translatedFormat('d
                                        F Y') }}</td>
                                    <td class="min-w-[60px] max-w-[80px] truncate">{{ $carRepair->car_issue ??
                                        'N/A' }}</td>
                                    <td class="min-w-[60px] max-w-[70px] truncate text-center">
                                        @php
                                        try {
                                            // แปลงวันที่จากฐานข้อมูล
                                            $date = \Carbon\Carbon::parse($carRepair->car_lastMaintenanceDate);
                                        } catch (\Exception $e) {
                                            $date = null;
                                        }

                                        if ($date && $date->format('Y-m-d') !== '1900-01-01') {
                                            $formattedDate = $date->translatedFormat('j F Y');

                                            // กำหนดสีตามเงื่อนไข
                                            if ($date->lessThan($today)) {
                                                $color = 'red'; // 🔴 เลยกำหนด (วันหมดอายุ)
                                            } elseif ($date->lessThanOrEqualTo($sevenDaysLater)) {
                                                $color = 'orange'; // 🟡 ใกล้หมดอายุ (เหลือไม่เกิน 7 วัน)
                                            } else {
                                                $color = 'black'; // ✅ ปกติ
                                            }

                                            echo "<span style='color: {$color};'>{$formattedDate}</span>";
                                        } else {
                                            echo '❌ วันที่ไม่ถูกต้อง';
                                        }
                                        @endphp
                                    </td>
                                    <td class="min-w-[50px] max-w-[60px] truncate text-center">
                                        @php
                                        try {
                                            // แปลงวันที่จากฐานข้อมูล
                                            $date = \Carbon\Carbon::parse($carRepair->car_preferredRepairDate);
                                        } catch (\Exception $e) {
                                            $date = null;
                                        }

                                        if ($date && $date->format('Y-m-d') !== '1900-01-01') {
                                            $formattedDate = $date->translatedFormat('j F Y');

                                            // กำหนดสีตามเงื่อนไข
                                            if ($date->lessThan($today)) {
                                                $color = 'red'; // 🔴 เลยกำหนด (วันหมดอายุ)
                                            } elseif ($date->lessThanOrEqualTo($sevenDaysLater)) {
                                                $color = 'orange'; // 🟡 ใกล้หมดอายุ (เหลือไม่เกิน 7 วัน)
                                            } else {
                                                $color = 'black'; // ✅ ปกติ
                                            }

                                            echo "<span style='color: {$color};'>{$formattedDate}</span>";
                                        } else {
                                            echo '❌ วันที่ไม่ถูกต้อง';
                                        }
                                        @endphp

                                    </td>
                                    <td class="min-w-[50px] max-w-[50px] truncate ">{{ $carRepair->car_additionalNotes
                                        ??
                                        '-'
                                        }}</td>
                                    <td class="min-w-[50px] max-w-[80px] truncate text-center">
                                        {{ $carRepair->car_requesterName ?? 'N/A' }}
                                    </td>
                                    <td class="min-w-[50px] max-w-[60px] truncate text-center">

                                        <a class="me-2" wire:click='confirmEdit({{ $carRepair->id }})'>
                                            <i class="fa-solid fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                                style="font-size: 18px; vertical-align: middle;"></i>
                                        </a>
                                        @can('delete IT')
                                        <a href="#" wire:click='confirmDelete({{ $carRepair->id }})'>
                                            <i class="fa-regular fa-trash-can text-danger hover:text-red-700 hover:scale-110"
                                                style="font-size: 18px; vertical-align: middle;"></i>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- ตัวแบ่งหน้า -->
                        <div class="flex mt-4">
                            {{-- {{ $carRepairs->links('pagination::tailwind') ?? '' }} --}}
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>
        </div>

        <!-- Model ADD  -->
        <x-modal title="ข้อมูลรถ" wire:model="showModalRepair" maxWidth="2xl" zIndex="20" closeModal="closeModalRepair">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateCarRepair' : 'saveCarRepair' }}"
                id="formAddCarRepair">

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เลขทะเบียน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-car-rear"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_id" name="car_id" wire:model="car_id" readonly />
                        </div>
                    </div>

                    <div class="">
                        <label for="car_issue"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            รายการ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_issue" name="car_issue" wire:model="car_issue" required />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_lastMaintenanceDate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ซ่อมครั้งล่าสุด
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_lastMaintenanceDate" name="car_lastMaintenanceDate"
                                wire:model="car_lastMaintenanceDate" required />
                        </div>
                    </div>

                    <div class="">
                        <label for="car_preferredRepairDate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            แผนการบำรุงรักษา
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-calendar-week"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_preferredRepairDate" name="car_preferredRepairDate"
                                wire:model="car_preferredRepairDate" required />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_garage"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ร้านซ่อม
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_garage" name="car_garage" wire:model="car_garage" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="car_warrantyInfo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ประกันซ่อม
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_warrantyInfo" name="car_warrantyInfo" wire:model="car_warrantyInfo" />
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                    <div class="">
                        <label for="car_additionalNotes"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            รายละเอียด
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-clipboard-user"></i>
                            </div>
                            <textarea type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_additionalNotes" name="car_additionalNotes" wire:model="car_additionalNotes">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_requesterName"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ผู้แจ้ง
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_requesterName" name="car_requesterName" wire:model="car_requesterName" />
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="car_canDrive" class="form-switch"
                                wire:model="car_canDrive" wire:change="updateCarStatus" {{ $car_canDrive ? 'checked' : '' }}>

                            <label class="ms-1.5" for="car_canDrive">
                                {{ $car_canDrive ? 'ขับได้' : 'ซ่อม' }}
                            </label>
                        </div>
                    </div>
                </div>

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
