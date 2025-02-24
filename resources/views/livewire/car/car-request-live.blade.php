<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายทรัพยากรบุคคล', 'title' => 'ขออนุญาตใช้รถ'])

    <div class="overflow-hidden card">
        <div class="px-6 pt-4 pb-0">
            <div class="flex items-center justify-end">
                <!-- ส่วนของปุ่มต่างๆ -->

                <button type="button"
                    class="px-4 py-2 text-sm font-bold text-white transition rounded-lg bg-primary hover:bg-blue-500 font-anuphan hover:shadow-lg hover:scale-105 btn"
                    wire:click='openModal'>
                    ขออนุญาต
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
                                @can('approver_car')
                                <th>
                                    สถานะ
                                </th>
                                @endcan
                                <th class="p-4">
                                    วันที
                                </th>
                                <th>
                                    ชื่อผู้ใช้งาน
                                </th>
                                <th>
                                    ภารกิจ
                                </th>
                                <th>
                                    ฝ่าย
                                </th>
                                <th class="min-w-[50px] max-w-[60px]">
                                    ขออนุญาตใช้รถ
                                </th>
                                <th>
                                    ผู้อนุญาต
                                </th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carRequests as $carRequest)
                            <tr class="border font-anuphan hover:bg-gray-100 hover:text-blue-500">
                                @can('approver_car')
                                <td class="min-w-[50px] max-w-[80px] truncate text-center">
                                    @if ( $carRequest->status_request == 1)
                                    <span
                                        class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 min-w-[80px] max-w-[80px]">
                                        <span class="w-1.5 h-1.5 inline-block bg-green-400 rounded-full"></span>
                                        อนุมัติ
                                    </span>
                                    @elseif ($carRequest->status_request == 2)
                                    <span
                                        class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 min-w-[80px] max-w-[80px]">
                                        <span class="w-1.5 h-1.5 inline-block bg-red-400 rounded-full"></span>
                                        ไม่อนุมัติ
                                    </span>
                                    @else
                                    <button
                                        class="inline-flex items-center justify-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 min-w-[80px] max-w-[80px]" wire:click.prevent='confirmApprove({{$carRequest->id}})'>
                                        <span class="animate-ping w-1.5 h-1.5 inline-block bg-blue-400 rounded-full"></span>
                                        รออนุมัติ
                                    </button>
                                    @endif
                                </td>
                                @endcan
                                <td class="p-2.5 text-center min-w-[60px] max-w-[70px] truncate">
                                    {{ \Carbon\Carbon::parse($carRequest->created_at)->locale('th')->translatedFormat('d F Y') }}</td>
                                <td class="min-w-[60px] max-w-[80px] truncate">{{ $carRequest->employee->EmpName ??
                                    'N/A' }}</td>
                                <td class="min-w-[60px] max-w-[150px] truncate">{{ $carRequest->job_request }}</td>
                                <td class="min-w-[60px] max-w-[70px] truncate">{{
                                    $carRequest->employee->webDept->DeptName ?? 'N/A' }} </td>
                                <td class="min-w-[50px] max-w-[60px] truncate">{{ $carRequest->carReport->car_number ??
                                    'N/A' }} {{ $carRequest->carReport->province->ProvinceName ?? 'N/A' }}</td>
                                <td class="min-w-[50px] max-w-[50px] truncate">{{ $carRequest->approver_request ?? '-'
                                    }}</td>

                                <td class="min-w-[50px] max-w-[60px] truncate flex items-center justify-end mt-2">
                                    @if($carRequest->status_request != 1 && $carRequest->status_request != 2)
                                    @can('approver_car')

                                    {{-- <a href="#" wire:click.prevent="confirmApprove({{ $carRequest->id }})"
                                        class="avtar avtar-xs btn-link-secondary me-2">
                                        <i class="fa-solid fa-circle-check text-success hover:text-green-700 hover:scale-110"
                                            style="font-size: 18px; vertical-align: middle;"></i>
                                    </a> --}}

                                    @endcan
                                    {{-- <a href="#" wire:click='confirmEdit({{ $carRequest->id }})'
                                        class="avtar avtar-xs btn-link-secondary me-2">
                                        <i class="fa-solid fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                            style="font-size: 18px; vertical-align: middle;"></i>
                                    </a> --}}

                                    @endif
                                    @can('delete IT')
                                    <a href="#" wire:click='confirmDelete({{ $carRequest->id }})'>
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
                        {{ $carRequests->links('pagination::tailwind') ?? '' }}
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>

        <!-- Model ADD  -->
        <x-modal title="ขออนุญาตใช้รถ" wire:model="showModal" maxWidth="md" zIndex="20" closeModal="closeModal">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updateCarRequest' : 'saveCarRequest' }}" id="formAddCarRequest">

                <div class="grid grid-cols-1 m-4 mb-6 md:grid-cols-1 font-prompt">
                    <label for="user_request"
                        class="inline-block mb-2 text-sm font-medium text-default-800">ชื่อผู้ใช้งาน</label>
                    <div class="flex mt-0">
                        <div
                            class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                        <select type="text"
                            class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                            id="user_request" name="user_request" wire:model="user_request" required>
                            <option selected value="">เลือก...</option>
                            @foreach ($employees as $employee )
                            <option value="{{ $employee->EmpID }}">{{ $employee->EmpName }} </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 m-4 mb-6 md:grid-cols-1 font-prompt">
                    <label for="department_request"
                        class="inline-block mb-2 text-sm font-medium text-default-800">ฝ่าย</label>
                    <div class="flex mt-0">
                        <div
                            class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                            <i class="fa-solid fa-building-user"></i>
                        </div>
                        <select type="text"
                            class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                            id="department_request" name="department_request" wire:model="department_request" required>
                            <option selected value="">เลือก...</option>
                            @foreach ($depts as $dept )
                            <option value="{{ $dept->DeptID }}">{{ $dept->DeptName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 m-4 mb-3 md:grid-cols-1 font-prompt">
                    <div class="">
                        <label for="job_request"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ภารกิจ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <textarea type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="job_request" name="job_request" wire:model="job_request">
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 m-4 mb-5 md:grid-cols-1 font-prompt">
                    <div class="flex items-center mt-2">
                        <input class="form-switch" type="checkbox" role="switch" id="use_check"
                            wire:model.live="use_check">
                        <label class=" ms-1.5" for="use_check">
                        ใช้รถ
                        </label>
                    </div>
                </div>

                @if($use_check == 1)
                <div class="grid grid-cols-1 m-4 mb-6 md:grid-cols-1 font-prompt">
                    <label for="car_request"
                        class="inline-block mb-2 text-sm font-medium text-default-800">ทะเบียนรถ</label>
                    <div class="flex mt-0">
                        <div
                            class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                            <i class="fa-solid fa-car"></i>
                        </div>
                        <select type="text"
                            class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                            id="car_request" name="car_request" wire:model="car_request">
                            <option selected value="">เลือก...</option>
                            @foreach ($carReports as $carReport )
                            <option value="{{ $carReport->id }}">{{ $carReport->car_number }} {{$carRequest->carReport->province->ProvinceName ?? 'N/A'}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

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

