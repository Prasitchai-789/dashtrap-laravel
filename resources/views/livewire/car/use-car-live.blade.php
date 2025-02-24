<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายยานยนต์', 'title' => 'ขออนุญาตใช้รถ'])

    <div class="overflow-hidden card">
        <div class="card-header">
            <h4 class="text-lg card-title font-prompt">ขออนุญาตออกนอกบริษัท</h4>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto custom-scroll">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead>
                                <tr class="font-prompt">
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        วันที่</th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        ผู้ใช้งาน
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        ทะเบียนรถ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        ภารกิจ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-center text-default-500">
                                        สถานะ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-center text-default-500">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                @foreach ($carRequests as $carRequest)
                                <tr class="font-bold font-anuphan hover:bg-gray-100 hover:text-blue-600">
                                    <td class="px-6 py-2 text-sm font-medium whitespace-nowrap">
                                        @if ($carRequest->created_at)
                                            {{ \Carbon\Carbon::parse($carRequest->created_at)->translatedFormat('j/m/y')
                                            }}
                                            @else
                                            ไม่ระบุวันที่
                                            @endif
                                        </td>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap">
                                        {{ $carRequest->employee->EmpName ?? '-' }}
                                    </td>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap">
                                        {{ $carRequest->carReport->car_number ?? 'N/A' }} {{
                                            $carRequest->carReport->province->ProvinceName ?? '-' }}
                                            </td>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap">
                                        {{ $carRequest->job_request }} </td>
                                    <td class="px-6 py-2 text-sm text-center whitespace-nowrap">
                                        @if ( $carRequest->status_request == 1)
                                        <span
                                        class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-green-500 text-white min-w-[80px] max-w-[80px]">
                                        <span class="w-1.5 h-1.5 inline-block bg-green-200 rounded-full"></span>
                                        อนุมัติ
                                    </span>
                                            @elseif ($carRequest->status_request == 2)
                                            <span
                                            class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-red-500 text-white min-w-[80px] max-w-[80px]">
                                            <span class="w-1.5 h-1.5 inline-block bg-red-200 rounded-full"></span>
                                            ไม่อนุมัติ
                                        </span>
                                            @else
                                            <span
                                            class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-blue-500 text-white min-w-[80px] max-w-[80px]">
                                            <span class="w-1.5 h-1.5 inline-block bg-blue-200 rounded-full"></span>
                                            รออนุมัติ
                                        </span>
                                            @endif
                                        </td>
                                    <td class="flex items-center justify-center px-6 py-2 text-sm font-medium whitespace-nowrap">
                                        @if($carRequest->status_request == 1)
                                        <div class="relative flex items-center justify-center w-6 h-6 cursor-pointer" wire:click='addCarUse({{ $carRequest->id }})'>
                                            <!-- วงกลม animation -->
                                            <span class="absolute inline-flex w-full h-full rounded-full animate-ping bg-primary/75"></span>

                                            <!-- ไอคอนรถ -->
                                            <i class="relative text-blue-500 fa-solid fa-car-rear hover:scale-110" style="font-size: 20px;"></i>
                                        </div>

                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card -->

    <div class="mt-2 overflow-hidden card">
        <div class="card-header">
            <h4 class="text-lg card-title font-prompt">บันทึกการเข้า - ออก</h4>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto custom-scroll">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead>
                                <tr class="font-prompt">
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        วันที่</th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        ผู้ใช้งาน
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        ทะเบียนรถ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        ภารกิจ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        เลขไมล์เริ่ม
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        เลขไมล์เสร็จ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        ระยะทาง (km.)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-start text-default-500">
                                        สถานะ
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-sm text-end text-default-500">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                @foreach ($useCars as $useCar)
                                <tr class="font-medium font-anuphan hover:bg-gray-100 hover:text-blue-600">
                                    <td class="px-6 py-2 text-sm font-medium whitespace-nowrap min-w-[50px] max-w-[150px] truncate">
                                        @if ($useCar->created_at)
                                        {{ \Carbon\Carbon::parse($useCar->created_at)->translatedFormat('j/m/y H:i')
                                        }}
                                        @else
                                        ไม่ระบุวันที่
                                        @endif
                                    </td>
                                    <td class="px-6 py-2 text-sm whitespace-nowrap min-w-[50px] max-w-[150px] truncate">
                                        {{ $useCar->employee->EmpName ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-2 text-sm min-w-[150px] max-w-[160px] truncate">
                                        {{ $useCar->carReport->car_number ?? 'N/A' }} {{
                                        $useCar->carReport->province->ProvinceName ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-2 text-sm min-w-[150px] max-w-[200px] truncate">
                                        {{ $useCar->use_job }}
                                    </td>
                                    <td class="px-6 py-2 text-sm font-bold whitespace-nowrap">
                                        {{ $useCar->use_start }}
                                    </td>
                                    <td class="px-6 py-2 text-sm font-bold whitespace-nowrap">
                                        {{ $useCar->use_end }}
                                    </td>
                                    <td class="px-6 py-2 text-sm font-bold whitespace-nowrap">
                                        {{ $useCar->use_distance }}
                                    </td>
                                    <td class="px-6 py-2 text-sm min-w-[130px] max-w-[140px] truncate text-center">
                                        @if ( $useCar->use_status == 1)
                                        <button
                                            class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 hover:bg-red-200 min-w-[90px] max-w-[100px] hover:shadow-lg hover:scale-105 btn"
                                            wire:click.prevent='end({{ $useCar->id }})'>
                                            <span class="w-1.5 h-1.5 inline-block bg-red-400 rounded-full"></span>
                                            นำรถไปใช้
                                        </button>
                                        @else
                                        <span
                                            class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 min-w-[90px] max-w-[100px]">
                                            <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                                            เสร็จภารกิจ
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2 text-sm font-medium min-w-[100px] max-w-[100px] truncate text-center">
                                        <a class="text-primary hover:text-primary-700" href="#" wire:click.prevent='editEnd({{ $useCar->id }})'>แก้ไข</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ตัวแบ่งหน้า -->
            <div class="flex mt-4 mb-2">
                {{ $useCars->links('pagination::tailwind') ?? '' }}
            </div>
        </div>

          <!-- Model END  -->
          <x-modal title="กรอกข้อมูลเลขไมล์" wire:model="showModalEnd" maxWidth="md" zIndex="20" closeModal="closeModalEnd">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateCarEnd' : 'saveCarEnd' }}" id="formAddCarEnd">

                <div class="grid grid-cols-1 m-4 mb-3 text-lg font-bold md:grid-cols-1 font-prompt">
                    <h1 class="mt-2 text-blue-900">ชื่อผู้ใช้งาน : {{ $user_name ?? 'N/A' }}</h1>
                    <h1 class="mt-2 text-blue-900">ทะเบียนรถ : {{ $car ?? 'N/A' }} {{ $car_province ?? 'N/A' }}</h1>
                    <h1 class="mt-2 text-blue-900">เลขไมล์เริ่ม : {{ $car_mileage ?? 'N/A' }} </h1>
                </div>

                <div class="grid grid-cols-1 m-4 mb-3 md:grid-cols-1 font-prompt">
                    <div class="">
                        <label for="use_end"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เลขไมล์เสร็จ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="use_end" name="use_end" wire:model="use_end" required />
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
        <!-- End Model End  -->
    </div> <!-- end card -->
</div>
