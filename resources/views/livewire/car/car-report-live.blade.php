<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายยานยนต์', 'title' => 'ข้อมูลรถ'])

    <div class="overflow-hidden card">
        <div class="px-6 pt-4 pb-0">
            <div class="flex flex-wrap items-center justify-start gap-2 font-prompt">
                <!-- ส่วนของปุ่มต่างๆ -->
                <button type="button"
                    class="px-4 py-2 text-sm font-bold text-white transition rounded-lg btn border-primary bg-primary hover:bg-blue-500 font-anuphan hover:shadow-lg hover:scale-105"
                    wire:click='openModal'>
                    เพิ่มรถ
                </button>
                <button type="button"
                    class="px-4 py-2 text-sm font-bold rounded-lg btn border-primary text-primary hover:bg-primary hover:text-white font-anuphan hover:shadow-lg hover:scale-105"
                    wire:click='openModalBrand'>
                    เพิ่มยี่ห้อ
                </button>
                <button type="button"
                    class="px-4 py-2 text-sm font-bold rounded-lg btn border-primary text-primary hover:bg-primary hover:text-white font-anuphan hover:shadow-lg hover:scale-105"
                    wire:click='openModalType'>
                    เพิ่มประเภทรถ
                </button>
                <button type="button"
                    class="px-4 py-2 text-sm font-bold rounded-lg btn border-primary text-primary hover:bg-primary hover:text-white font-anuphan hover:shadow-lg hover:scale-105"
                    wire:click='openModalCharacter'>
                    เพิ่มลักษณะรถ
                </button>
            </div>
        </div>

        <div class="card-header">
            <!-- Table -->
            <div class="">
                <div class="overflow-x-auto rounded-lg font-anuphan">
                    <table class="w-full border border-collapse">
                        <thead class="text-center bg-gray-200 ">
                            <tr class="font-prompt">
                                <th class="p-4">
                                    ลำดับ
                                </th>
                                <th>
                                    ทะเบียนรถ
                                </th>
                                <th>
                                    ยี่ห้อ
                                </th>
                                <th>
                                    เลขไมล์
                                </th>
                                <th class="min-w-[50px] max-w-[60px]">
                                    ภาษี
                                </th>
                                <th>
                                    ประกันภัย
                                </th>
                                <th>
                                    ระยะเปลี่ยนถ่าย
                                </th>
                                <th>
                                    สถานะ
                                </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carReports as $carReport)
                            <tr class="border font-anuphan hover:bg-gray-100 hover:text-blue-500">
                                <td class="p-2.5 text-center min-w-[60px] max-w-[70px] truncate">{{
                                    ($carReports->firstItem() + $loop->index) }}</td>
                                <td class="min-w-[60px] max-w-[80px] truncate">{{ $carReport->car_number }} {{
                                    $carReport->province->ProvinceName ?? 'N/A' }}</td>
                                <td class="min-w-[60px] max-w-[80px] truncate">{{ $carReport->brand->car_brand_list ??
                                    'N/A' }}</td>
                                <td class="min-w-[60px] max-w-[80px] truncate text-center">{{ $carReport->car_mileage == 0 ? '' :
                                    $carReport->car_mileage }}</td>
                                <td class="text-center">
                                    @php
                                    try {
                                        // แปลงวันที่จากฐานข้อมูล
                                        $date = \Carbon\Carbon::parse($carReport->car_tax);
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

                                <td class="text-center">
                                    @php
                                    try {
                                        // แปลงวันที่จากฐานข้อมูล
                                        $date = \Carbon\Carbon::parse($carReport->car_insurance);
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

                                <td class="text-center"></td>
                                <td class="text-center">
                                    @if ($carReport->car_status == 1)
                                    <span
                                        class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 min-w-[80px] max-w-[80px]">
                                        <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                                        ใช้งาน
                                    </span>
                                    @else
                                    <span
                                        class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 min-w-[80px] max-w-[80px]">
                                        <span class="w-1.5 h-1.5 inline-block bg-red-400 rounded-full"></span>
                                        ซ่อม
                                    </span>
                                    @endif
                                </td>
                                <td class="min-w-[90px] max-w-[90px]  flex items-center justify-end mt-2">
                                    {{-- {{ route('car-view.index', ['carReportId' => $carReport->id]) }} --}}
                                    <a href="{{ route('car-view', ['carReportId' => $carReport->id]) }}">
                                        <i class="me-4 fa-regular fa-eye text-primary hover:text-blue-700 hover:scale-110"
                                            style="font-size: 16px; vertical-align: middle;"></i>
                                    </a>
                                    <a href="javascript:void(0)" wire:click='confirmEdit({{ $carReport->id }})'>
                                        <i class="me-4 fa-regular fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                            style="font-size: 16px; vertical-align: middle;"></i>
                                    </a>
                                    <a href="javascript:void(0)" wire:click='confirmDelete({{ $carReport->id }})'>
                                        <i class="fa-regular fa-trash-can text-danger hover:text-red-700 hover:scale-110"
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
             <!-- ตัวแบ่งหน้า -->
             <div class="flex mt-4">
                {{ $carReports->links('pagination::tailwind') ?? '' }}
            </div>
        </div>

        <!-- Model ADD  -->
        <x-modal title="ข้อมูลรถ" wire:model="showModal" maxWidth="4xl" zIndex="20" closeModal="closeModal">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateCarReport' : 'saveCarReport' }}" method="POST"
                id="formAddCarReport">

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เลขทะเบียน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_number" name="car_number" wire:model="car_number" required />
                        </div>
                    </div>

                    <div class="">
                        <label for="car_county"
                            class="inline-block mb-2 text-sm font-medium text-default-800">จังหวัด</label>
                        <div class="flex mt-0">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_county" name="car_county" wire:model="car_county" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($provinces as $province )
                                <option selected value="{{$province->ProvinceID}}">{{$province->ProvinceName}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_type"
                            class="inline-block mb-2 text-sm font-medium text-default-800">ประเภทรถ</label>
                        <div class="flex mt-0">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-car-rear"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_type" name="car_type" wire:model="car_type" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($carTypes as $carType )
                                <option selected value="{{$carType->id}}">{{$carType->car_type_list}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="">
                        <label for="car_character"
                            class="inline-block mb-2 text-sm font-medium text-default-800">ลักษณะรถ</label>
                        <div class="flex mt-0">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-car-rear"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_character" name="car_character" wire:model="car_character" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($carCharacters as $carCharacter )
                                <option selected value="{{$carCharacter->id}}">{{$carCharacter->car_character_list}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_brand"
                            class="inline-block mb-2 text-sm font-medium text-default-800">ยี่ห้อรถ</label>
                        <div class="flex mt-0">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-car-rear"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_brand" name="car_brand" wire:model="car_brand" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($carBrands as $carBrand )
                                <option selected value="{{$carBrand->id}}">{{$carBrand->car_brand_list}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="car_model"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            รุ่น
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-swatchbook"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_model" name="car_model" wire:model="car_model"  />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_color"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            สี
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-palette"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_color" name="car_color" wire:model="car_color" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="car_year"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ปีที่ผลิต
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-hands-holding-circle"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_year" name="car_year" wire:model="car_year"  />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_fuel"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            น้ำมันเชื้อเพลิง
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-gas-pump"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_fuel" name="car_fuel" wire:model="car_fuel" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="car_mileage"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เลขไมล์
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_mileage" name="car_mileage" wire:model="car_mileage" required />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            วันจดทะเบียน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_date" name="car_date" wire:model="car_date" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="car_buy"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            วันที่ซื้อ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_buy" name="car_buy" wire:model="car_buy" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="car_tax"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ภาษี
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_tax" name="car_tax" wire:model="car_tax" />
                        </div>
                    </div>
                    <div class="">
                        <label for="car_insurance"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ประกันภัย
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_insurance" name="car_insurance" wire:model="car_insurance" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-3 font-anuphan">
                    <div class="">
                        <label for="car_department"
                            class="inline-block mb-2 text-sm font-medium text-default-800">ฝ่ายที่ดูแล</label>
                        <div class="flex mt-0">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_department" name="car_department" wire:model="car_department" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($departments as $department )
                                <option selected value="{{$department->DeptID}}">{{$department->DeptName}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="car_status" class="form-switch"
                                wire:model="car_status" wire:change="updateCarStatus" {{ $car_status ? 'checked' : '' }}>

                            <label class="ms-1.5" for="car_status">
                                {{ $car_status ? 'ใช้งาน' : 'ซ่อม' }}
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center mt-6">
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="car_card" class="form-switch"
                                wire:model="car_card" wire:change="updateCarStatus" {{ $car_card ? 'checked' : '' }}>

                            <label class="ms-1.5" for="car_card">
                                {{ $car_card ? 'เก็บสถิติ' : '-' }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                    <div class="">
                        <label for="car_details"
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
                                id="car_details" name="car_details" wire:model="car_details">
                            </textarea>
                        </div>
                    </div>
                </div>

                 <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                    <div class="">
                        <label class="mb-2 font-bold form-label">รูปภาพ</label>

                        <div class="">
                            <input type="file" class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500" id="car_photo" name="car_photo"
                                wire:model="car_photo" accept="image/jpeg,image/png">

                            @error('car_photo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- แสดงตัวอย่างรูปภาพที่เลือก -->
                        {{-- @if ($car_photo)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">รูปตัวอย่าง:</p>
                                <img src="{{ $car_photo->temporaryUrl() }}" class="w-40 h-40 rounded-lg shadow-md">
                            </div>
                        @endif --}}


                        @if (session()->has('message'))
                            <p class="mt-2 text-green-500">{{ session('message') }}</p>
                        @endif
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

        <!-- Model ADD Brand -->
        <x-modal title="ข้อมูลยี่ห้อรถ" wire:model="showModalBrand" maxWidth="lg" zIndex="20"
            closeModal="closeModalBrand">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateBrand' : 'saveBrand' }}" id="formAddBrand" method="POST">

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                    <div class="">
                        <label for="car_brand_list"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ยี่ห้อรถ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_brand_list" name="car_brand_list" wire:model="car_brand_list" required />
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

        <!-- Model ADD Type -->
        <x-modal title="ข้อมูลประเภทรถ" wire:model="showModalType" maxWidth="lg" zIndex="20"
            closeModal="closeModalType">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateCarType' : 'saveCarType' }}" id="formAddCarType" method="POST">

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                    <div class="">
                        <label for="car_type_list"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ประเภทรถ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_type_list" name="car_type_list" wire:model="car_type_list" required />
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

        <!-- Model ADD Character -->
        <x-modal title="ข้อมูลเพิ่มลักษณะรถ" wire:model="showModalCharacter" maxWidth="lg" zIndex="20"
            closeModal="closeModalCharacter">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateCarCharacter' : 'saveCarCharacter' }}" method="POST"
                id="formAddCarCharacter">

                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                    <div class="">
                        <label for="car_character_list"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เพิ่มลักษณะรถ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="car_character_list" name="car_character_list" wire:model="car_character_list"
                                required />
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
