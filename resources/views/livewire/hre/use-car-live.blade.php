<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายทรัพยากรบุคคล', 'title' => 'ขออนุญาตใช้รถ'])

    <div class="overflow-hidden card">
        <div class="card-header">
            <div class="flex items-center justify-between">
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
                    class="px-4 py-2 text-sm font-bold text-white transition rounded-lg bg-primary hover:bg-blue-500 font-anuphan"
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
                            <th scope="col" class="px-6 py-3 text-sm truncate text-start text-default-500">
                                วันที่</th>
                            <th scope="col" class="px-6 py-3 text-sm truncate text-start text-default-500">
                                ชื่อผู้ใช้งาน
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm truncate text-start text-default-500">
                                ภารกิจ
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm truncate text-start text-default-500">
                                ฝ่าย
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm truncate text-start text-default-500">
                                ขออนุญาตใช้รถ
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm truncate text-start text-default-500">
                                ผู้อนุญาต
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm truncate text-start text-default-500">
                                สถานะ
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm truncate text-end text-default-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($useCars as $useCar)

                            @endforeach
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                {{ \Carbon\Carbon::parse($useCar->created_at)->locale('th')->translatedFormat('d F
                                    Y') }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                {{ $useCar->employee->EmpName }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                {{ $useCar->use_job }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                {{ $useCar->employee->webDept->DeptName }} </td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                {{ $useCar->carReport->car_number ?? 'N/A' }} {{
                                            $useCar->carReport->province->ProvinceName ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                {{ $useCar->employee->EmpName }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                @if ( $useCar->use_status == 1)
                                <span class="badge bg-danger btn" data-bs-toggle="modal"
                                    data-bs-target="#endModal" class="avtar avtar-xs btn-link-secondary"
                                    wire:click='end({{ $useCar->id }})'>นำรถไปใช้</span>
                                @else
                                <span class="badge bg-success btn">เสร็จภารกิจ</span>
                                @endif</td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                <a class="text-primary hover:text-primary-700" href="#">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex mt-4">
                    {{-- {{ $webappPOInvs->links() ?? '' }} --}}
                </div>
            </div>
        </div>
        <!-- End Table -->
    </div>
</div>
