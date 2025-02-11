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
                            @foreach ($carRequests as $carRequest)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-default-800">
                                    {{ \Carbon\Carbon::parse($carRequest->created_at)->locale('th')->translatedFormat('d
                                    F
                                    Y') }}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                    {{ $carRequest->employee->EmpName }}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                    {{ $carRequest->job_request }}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                    {{ $carRequest->employee->webDept->DeptName }} </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                    {{ $carRequest->carReport->car_number ?? 'N/A' }} {{
                                    $carRequest->carReport->province->ProvinceName ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                    {{ $carRequest->approver_request }}</td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap text-default-800">
                                    @if ( $carRequest->status_request == 1)
                                    <span class="badge bg-success">อนุมัติ</span>
                                    @elseif ($carRequest->status_request == 2)
                                    <span class="badge bg-danger">ไม่อนุมัติ</span>
                                    @else
                                    <span class="badge bg-primary">รออนุมัติ</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                    @if($carRequest->status_request != 1 && $carRequest->status_request != 2)
                                    @can('approver_car')

                                    <a href="#" wire:click.prevent="confirmApprove({{ $carRequest->id }})"
                                        class="avtar avtar-xs btn-link-secondary">
                                        <i class="ph ph-check-circle text-success text-middle"
                                            style="font-size: 22px;"></i>
                                    </a>

                                    @endcan
                                    <a href="#" wire:click='confirmEdit({{ $carRequest->id }})' data-bs-toggle="modal"
                                        data-bs-target="#carRequestModal" class="avtar avtar-xs btn-link-secondary">
                                        <i class="bi bi-pencil-square text-warning"
                                            style="font-size: 18px; vertical-align: middle;"></i>
                                    </a>

                                    @endif
                                    @can('delete IT')
                                    <a href="#" wire:click='confirmDelete({{ $carRequest->id }})'
                                        class="avtar avtar-xs btn-link-secondary" data-bs-toggle="modal"
                                        data-bs-target="#">
                                        <i class="bi bi-trash text-danger"
                                            style="font-size: 18px; vertical-align: middle;"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex mt-4">
                        {{ $carRequests->links() ?? '' }}
                    </div>
                </div>
            </div>
            <!-- End Table -->

            <table class="table-fixed">
                <thead>
                  <tr>
                    <th>Song</th>
                    <th>Artist</th>
                    <th>Year</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                    <td>Malcolm Lockyer</td>
                    <td>1961</td>
                  </tr>
                  <tr>
                    <td>Witchy Woman</td>
                    <td>The Eagles</td>
                    <td>1972</td>
                  </tr>
                  <tr>
                    <td>Shining Star</td>
                    <td>Earth, Wind, and Fire</td>
                    <td>1975</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
