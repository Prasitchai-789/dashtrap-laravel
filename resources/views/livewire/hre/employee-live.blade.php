<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายทรัพยากรบุคคล', 'title' => 'ข้อมูลพนักงาน'])

    <div class="page-header">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-xl font-semibold"></h4>
                <button type="button"
                    class="px-4 py-2 text-sm text-white transition rounded-lg bg-primary hover:bg-blue-500"
                    wire:click=openModal @click="show = true">
                    CREATE
                </button>
            </div>

            <!-- Table -->
            <div class="">
                <div class="overflow-x-auto rounded-lg font-anuphan">
                    <table class="w-full border border-collapse ">
                        <thead class="text-center bg-gray-200">
                            <tr class="border">
                                <th class="p-3 border">รหัสพนักงาน</th>
                                <th class="p-3 border">ชื่อ</th>
                                <th class="p-3 border">ตำแหน่ง</th>
                                <th class="p-3 border">ฝ่าย</th>
                                <th class="p-3 border">วันที่เริ่มงาน</th>
                                <th class="p-3 border">วันเกิด</th>
                                <th class="p-3 border">วุฒิการศึกษา</th>
                                <th class="p-3 text-center border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                <td class="p-3 border">{{$employee->EmpCode}}</td>
                                <td class="p-3 border">{{$employee->empTitle->EmpTitleName}}{{$employee->EmpName}}</td>
                                <td class="p-3 border">{{$employee->Position}}</td>
                                <td class="p-3 border">{{$employee->webDept->DeptName}}</td>
                                <td class="p-3 border">{{
                                    \Carbon\Carbon::parse($employee->BeginWorkDate)->locale('th')->translatedFormat('d F
                                    Y') }}</td>
                                <td class="p-3 border">{{
                                    \Carbon\Carbon::parse($employee->BirthDay)->locale('th')->translatedFormat('d F Y')
                                    }}</td>
                                <td class="p-3 border">{{$employee->education->EduName}}</td>
                                <td class="p-3 text-center border">
                                    <div class="relative hs-dropdown">
                                        <button id="hs-dropdown-default" type="button" class="inline-flex items-center justify-center px-5 py-2 text-lg font-semibold tracking-wide text-center text-gray-900 align-middle duration-500 rounded-md hs-dropdown-toggle hover:text-blue-500">
                                            ...
                                        </button>

                                        <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 min-w-48 transition-[opacity,margin] mt-4 opacity-0 z-10 bg-white shadow-lg rounded-lg border border-default-100 p-1.5 hidden">
                                            <ul class="flex flex-col gap-1">
                                                <li>
                                                    <a class="flex items-center px-3 py-2 font-normal transition-all rounded text-default-600 hover:text-blue-400 hover:bg-default-400/10"
                                                    href="#" wire:click='confirmEdit({{ $employee->EmpID }})'>
                                                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit</a>
                                                </li>
                                                @can('delete user')
                                                <li>
                                                    <a class="flex items-center px-3 py-2 font-normal text-red-500 transition-all rounded hover:text-red-600 hover:bg-default-400/10"
                                                    href="#" wire:click='confirmDelete({{ $employee->EmpID }})'> <i class="fa-solid fa-trash me-2"></i> Delete</a>
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
                        {{ $employees->links() ?? '' }}
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>

        <!-- Model ADD Employee -->
        <x-modal title="ข้อมูลการผลิต" wire:model="showModal" maxWidth="6xl" zIndex="20" closeModal="closeModal">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateEmployee' : 'saveEmployee' }}" id="myForm">
                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-4 font-anuphan">
                    <div class="">
                        <label for="EmpCode"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            รหัสพนักงาน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-users-between-lines"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="EmpCode" name="EmpCode" wire:model="EmpCode" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="EmpTitle"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            คำนำหน้า
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="EmpTitle" name="EmpTitle" wire:model="EmpTitle" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($EmpTitles as $EmpTitle)
                                <option value="{{ $EmpTitle->EmpTitleID }}" {{ old('EmpTitleID')==$EmpTitle->
                                    EmpTitleID ? 'selected' : '' }}>
                                    {{ $EmpTitle->EmpTitleName }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="sm:col-span-1 md:col-span-2">
                        <label for="EmpName"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ชื่อ-นามสกุล
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="EmpName" name="EmpName" wire:model="EmpName" required />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-4 font-anuphan">
                    <div class="">
                        <label for="IDCardNumber"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เลขที่บัตรประชาชน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="IDCardNumber" name="IDCardNumber" wire:model="IDCardNumber" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="BirthDay"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            วันเกิด
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-cake-candles"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="BirthDay" name="BirthDay" wire:model="BirthDay" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="EduID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            วุฒิการศึกษา
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="EduID" name="EduID" wire:model="EduID" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($Educations as $Education)
                                <option value="{{ $Education->EduID }}" {{ old('EduID')==$Education->
                                    EduID ? 'selected' : '' }}>
                                    {{ $Education->EduName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="ReligionID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ศาสนา
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-hands-praying"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="ReligionID" name="ReligionID" wire:model="ReligionID" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($Religions as $Religion)
                                <option value="{{ $Religion->ReligionID }}" {{ old('ReligionID')==$Religion->
                                    ReligionID ? 'selected' : '' }}>
                                    {{ $Religion->ReligionName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="m-4 mt-2 border-t border-default-200">

                <div class="grid grid-cols-1 gap-4 m-4 mt-0 mb-2 md:grid-cols-2 font-anuphan">
                    <div class="">
                        <label for="Company"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            บริษัทที่สังกัด
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Company" name="Company" wire:model="Company" required />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-3 font-anuphan">
                    <div class="">
                        <label for="Position"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ตำแหน่ง
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Position" name="Position" wire:model="Position" required />
                        </div>
                    </div>
                    <div class="">
                        <label for="DeptID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ฝ่าย
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-network-wired"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="DeptID" name="DeptID" wire:model="DeptID" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($depts as $dept)
                                <option value="{{ $dept->DeptID }}" {{ old('DeptID')==$dept->
                                    DeptID ? 'selected' : '' }}>
                                    {{ $dept->DeptName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="BeginWorkDate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            วันที่เริ่มงาน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <input type="date" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="BeginWorkDate" name="BeginWorkDate" wire:model="BeginWorkDate" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-1 font-anuphan">
                    <div class="">
                        <label for="Address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ที่อยู่
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Address" name="Address" wire:model="Address" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-3 font-anuphan">
                    <div class="">
                        <label for="ProvinceID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            จังหวัด
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="ProvinceID" name="ProvinceID" wire:model="ProvinceID" required
                                wire:change="getProvinces">
                                <option selected value="">เลือก...</option>
                                @foreach ($Provinces as $Province)
                                <option value="{{ $Province->ProvinceID }}" {{ old('ProvinceID')==$Province->
                                    ProvinceID ? 'selected' : '' }}>
                                    {{ $Province->ProvinceName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="DistID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            อำเภอ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="DistID" name="DistID" wire:model="DistID" required wire:change="getDistricts">
                                <option selected value="">เลือก...</option>
                                @foreach ($Districts as $District)
                                <option value="{{ $District->DistrictID }}"
                                    {{ $District->DistrictID == $DistID ? 'selected' : '' }}>
                                    {{ $District->DistrictName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="SubDistID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ตำบล
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="SubDistID" name="SubDistID" wire:model="SubDistID" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($SubDistricts as $SubDistrict)
                                <option value="{{ $SubDistrict->SubDistrictID }}"
                                    {{ $SubDistrict->SubDistrictID == $SubDistID ? 'selected' : '' }}>
                                    {{ $SubDistrict->SubDistrictName }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-3 font-anuphan">
                    <div class="">
                        <label for="ZipCode"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            รหัสไปรษณีย์
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                @
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="ZipCode" name="ZipCode" wire:model="ZipCode" />
                        </div>
                    </div>
                    <div class="">
                        <label for="Email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            Email
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <input type="email" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Email" name="Email" wire:model="Email" />
                        </div>
                    </div>
                    <div class="">
                        <label for="Tel"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เบอร์โทรศัพท์
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-mobile-screen-button"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Tel" name="Tel" wire:model="Tel" />
                        </div>
                    </div>
                </div>

                <div class="col-span-3 m-4 font-anuphan">
                    <div class="form-check">
                        <input class="font-semibold text-blue-900 rounded form-checkbox" type="checkbox" value=""
                            id="invalidCheck2" required>
                        <label class="ms-1.5" for="invalidCheck2">
                            สถานะปฎิบัติงาน
                        </label>
                    </div>
                </div>


                <div class="flex items-center justify-end px-4 py-3 mt-6 border-t gap-x-2 border-default-200">
                    {{-- <button type="button" class="text-white btn bg-primary" data-hs-overlay="#modal-employee"
                        wire:click="closeModal">
                        <i class="i-tabler-x me-1"></i>
                        Close
                    </button> --}}
                    <button type="submit" class="text-white btn bg-primary" href="#">
                        {{ $edit ? ' Update' : ' Save' }}
                    </button>
                </div>
            </form>
        </x-modal>
        <!-- End Model ADD Employee -->

    </div>
</div>
