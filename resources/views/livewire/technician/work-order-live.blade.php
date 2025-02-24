<div>
    @include('layouts.root/page-title', ['subtitle' => 'ช่างซ่อมบำรุง', 'title' => 'รายงานแจ้งซ่อม'])

    <div class="grid gap-5 mb-2 xl:grid-cols-4 md:grid-cols-2">
        <div class="card border-left-blue">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        {{-- class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span> --}}
                    <h5 class="truncate card-title font-prompt">รอดำเนินการ</h5>
                </div>

                <div class="flex items-center justify-end mb-4">
                    <h2 class="text-3xl font-medium text-default-800"> {{ $count1 }}
                        <span class="text-sm"> รายการ</span>
                    </h2>
                    {{-- <span class="flex items-center">
                        <span class="text-sm text-default-400"></span>
                        @if (2==2)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span> --}}
                </div>

                {{-- <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-primary" role="progressbar"
                        aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: ;">
                    </div>
                </div> --}}
            </div>
            <!--end card body-->
        </div>

        <div class="card border-left-yellow">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        {{-- class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span> --}}
                    <h5 class="truncate card-title font-prompt">กำลังดำเนินการ</h5>
                </div>

                <div class="flex items-center justify-end mb-4">
                    <h2 class="text-3xl font-medium text-default-800"> {{ $count2 }}
                        <span class="text-sm"> รายการ</span>
                    </h2>
                    {{-- <span class="flex items-center">
                        <span class="text-sm text-default-400"></span>
                        @if (1==2)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span> --}}
                </div>

                {{-- <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-danger" role="progressbar"
                        aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: ;">
                    </div>
                </div> --}}
            </div>
            <!--end card body-->
        </div>

        <div class="card border-left-red">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        {{-- class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span> --}}
                    <h5 class="truncate card-title font-prompt">ส่งซ่อมภายนอก</h5>
                </div>

                <div class="flex items-center justify-end mb-4">
                    <h2 class="text-3xl font-medium text-default-800"> {{ $count3 }}
                        <span class="text-sm"> รายการ</span>
                    </h2>
                    {{-- <span class="flex items-center">
                        <span class="text-sm text-default-400"></span>
                        @if (2>1)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span> --}}
                </div>

                {{-- <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-warning" role="progressbar"
                        aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: ;">
                    </div>
                </div> --}}
            </div>
            <!--end card body-->
        </div>

        <div class="card border-left-green">
            <div class="card-body">
                <div class="mb-4">
                    <span
                        {{-- class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span> --}}
                    <h5 class="truncate card-title font-prompt">ดำเนินการเสร็จ</h5>
                </div>

                <div class="flex items-center justify-end mb-4">
                    <h2 class="text-3xl font-medium text-default-800"> {{ $count4 }}
                        <span class="text-sm">รายการ</span>
                    </h2>
                    {{-- <span class="flex items-center">
                        <span class="text-sm text-default-400"></span>
                        @if (1>2)
                        <i class="fa-solid fa-arrow-up text-success ms-2"></i>
                        @else
                        <i class="fa-solid fa-arrow-down text-danger ms-2"></i>
                        @endif
                    </span> --}}
                </div>

                {{-- <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center overflow-hidden rounded-full bg-success" role="progressbar"
                        aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: ;">
                    </div>
                </div> --}}
            </div>
            <!--end card body-->
        </div>
    </div>

    <div class="page-header">
        <div class="page-header">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-end mb-2">
                    <!-- ส่วนของปุ่มต่างๆ -->
                    <button type="button"
                        class="px-4 py-2 text-sm text-white transition rounded-lg bg-primary hover:bg-blue-500 hover:shadow-lg hover:scale-105"
                        wire:click='openModal'>
                        CREATE
                    </button>
                </div>


                <!-- Table -->
                <div class="">
                    <div class="overflow-x-auto font-anuphan">
                        <table class="w-full border border-collapse">
                            <thead class="text-center bg-gray-200">
                                <tr class="border ">
                                    <th class="p-3 border">วันที่</th>
                                    <th class="p-3 border">ผู้แจ้ง</th>
                                    <th class="p-3 border">สถานะ</th>
                                    <th class="p-3 border">ชื่อเครื่อง</th>
                                    <th class="p-3 border">รายละเอียด</th>
                                    <th class="p-3 border">สถานที่</th>
                                    <th class="p-3 border">เบอร์โทรศัพท์</th>
                                    <th class="p-3 text-center border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($workOrders as $workOrder )
                                <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary border-y">
                                    <td class="p-2.5 font-semibold text-center">{{
                                        \Carbon\Carbon::parse($workOrder->created_at)->locale('th')->translatedFormat('d/m/Y')
                                        }}</td>
                                    <td class="p-1 font-semibold text-start">{{ $workOrder->NameOfInformant }}</td>
                                    <td class="p-1 font-semibold text-center">
                                        @if ($workOrder->Status == 1)
                                        <button type="button"
                                            class="px-3 py-1 text-white rounded-full btn bg-blue-500 min-w-[150px] max-w-[150px] hover:bg-blue-600 hover:text-white hover:shadow-lg hover:scale-105"
                                            wire:click='changeStatus({{ $workOrder->id }})'> <i
                                                class="fa-solid fa-hourglass-start"></i> รอดำเนินการ
                                        </button>
                                        @elseif ($workOrder->Status == 2)
                                        <button type="button"
                                            class="px-3 py-1 text-white rounded-full btn bg-yellow-500 min-w-[150px] max-w-[150px] hover:bg-yellow-600 hover:text-white hover:shadow-lg hover:scale-105"
                                            wire:click='changeStatus({{ $workOrder->id }})'>
                                            <i class="fa-solid fa-screwdriver-wrench"></i>
                                            กำลังดำเนินการ
                                        </button>
                                        @elseif ($workOrder->Status == 3)
                                        <button type="button"
                                            class="px-3 py-1 text-white rounded-full btn bg-orange-500 min-w-[150px] max-w-[150px] hover:bg-orange-600 hover:text-white hover:shadow-lg hover:scale-105"
                                            wire:click='changeStatus({{ $workOrder->id }})'>
                                            <i class="fa-regular fa-paper-plane"></i>
                                            ส่งซ่อมภายนอก
                                        </button>
                                        @elseif ($workOrder->Status == 4)
                                        <span
                                            class="px-3 py-1 text-white rounded-full btn bg-green-500 min-w-[150px] max-w-[150px]">
                                            <i class="fa-regular fa-circle-check"></i>
                                            ดำเนินการเสร็จ</span>
                                        @else
                                        <span
                                            class="px-3 py-1 text-white rounded-full btn bg-red-500 min-w-[150px] max-w-[150px]">
                                            <i class="fa-solid fa-ban"></i>
                                            ยกเลิก</span>
                                        @endif
                                    </td>
                                    <td class="p-1 font-semibold text-start">{{ $workOrder->MachineName }}</td>
                                    <td class="p-1 font-semibold text-start">{{ $workOrder->Detail }}</td>
                                    <td class="p-1 font-semibold text-start">{{ $workOrder->Location }}</td>
                                    <td class="p-1 font-semibold text-center">{{ $workOrder->Telephone }}</td>

                                    <td class="flex items-center justify-end p-2.5 mx-2">
                                        @if($workOrder->TypeWork == 1)
                                        <a href="#" wire:click='generatePdf({{ $workOrder->id }})'
                                            <i class="text-blue-500 me-4 fa-solid fa-copy hover:text-blue-600 hover:scale-110"
                                            style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @endif
                                        <a href="#" wire:click='confirmEdit({{ $workOrder->id  }})'>
                                            <i class="me-4 fa-regular fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @can('delete user')
                                        <a href="#" wire:click='confirmDelete({{ $workOrder->id }})'>
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
                            {{ $workOrders->links('pagination::tailwind') ?? '' }}
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>


            <!-- Model ADD  -->
            <x-modal title="บันทึกการแจ้งซ่อม" wire:model="showModal" maxWidth="2xl" zIndex="20"
                closeModal="closeModal">

                <form wire:submit.prevent="{{ $edit ? ' updateEdit' : ' saveWorkOrder' }}" id="formAddWeight">

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="NameOfInformant"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ชื่อผู้แจ้ง
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-blue-100 border border-blue-200 rounded-s-md border-e-0">
                                    <i class="fa-regular fa-circle-user"></i>
                                </div>
                                <input type="text" placeholder="ชื่อผู้แจ้ง"
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="NameOfInformant" name="NameOfInformant" wire:model="NameOfInformant" required />
                            </div>
                        </div>
                        <div class="">
                            <label for="TypeWork"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ประเภทงาน
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-blue-100 border border-blue-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                <select type="text"
                                    class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="TypeWork" name="TypeWork" wire:model="TypeWork" required>
                                    <option selected value="">เลือกประเภท...</option>
                                    @foreach ($typeWorks as $typeWork)
                                    <option value="{{ $typeWork->TypeWorkID }}">
                                        {{ $typeWork->TypeWork }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="MachineName"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ชื่อเครื่อง
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-blue-100 border border-blue-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <input type="text" placeholder="ชื่อเครื่อง"
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="MachineName" name="MachineName" wire:model="MachineName" required />
                            </div>
                        </div>
                        <div class="">
                            <label for="MachineCode"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                รหัสเครื่อง
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-blue-100 border border-blue-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-download"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="MachineCode" name="MachineCode" wire:model="MachineCode" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="Location"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                สถานที่
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-blue-100 border border-blue-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                <select type="text"
                                    class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Location" name="Location" wire:model="Location" required>
                                    <option selected value="">
                                        เลือกสถานที่...</option>
                                    <option value="ออฟฟิศ">ออฟฟิศ</option>
                                    <option value="ห้องพยาบาล">ห้องพยาบาล
                                    </option>
                                    <option value="ห้องการเงิน">ห้องการเงิน
                                    </option>
                                    <option value="ห้อง QMR">ห้อง QMR</option>
                                    <option value="ห้องผู้บริหาร">ห้องผู้บริหาร
                                    </option>
                                    <option value="ห้อง Lab">ห้อง Lab</option>
                                    <option value="ห้องวิศวกรรม">ห้องวิศวกรรม
                                    </option>
                                    <option value="ห้องสโตร์">ห้องสโตร์
                                    </option>
                                    <option value="ป้อมรปภ.">ป้อมรปภ.</option>
                                    <option value="ห้องประชุมใหญ่">
                                        ห้องประชุมใหญ่</option>
                                    <option value="โรงอาหาร">โรงอาหาร</option>
                                    <option value="ส่วนโรงงาน">ส่วนโรงงาน
                                    </option>
                                    <option value="โรงคัดแยกขยะ">โรงคัดแยกขยะ
                                    </option>
                                    <option value="บ้านพักด้านหลัง">
                                        บ้านพักด้านหลัง</option>
                                    <option value="บ้านพักข้างนอก">
                                        บ้านพักข้างนอก</option>
                                    <option value="อาคารกู้ภัย">อาคารกู้ภัย
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <label for="Telephone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                เบอร์โทรศัพท์
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-blue-100 border border-blue-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-download"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Telephone" name="Telephone" wire:model="Telephone" />
                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                        <div class="">
                            <label for="Detail"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                รายละเอียด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-blue-100 border border-blue-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <textarea type="text" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Detail" name="Detail" wire:model="Detail">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- ปุ่ม submit -->
                    <div class="flex items-center justify-end px-4 py-3 mt-6 border-t gap-x-2 border-default-200">
                        <button type="submit" class="text-white btn bg-primary" href="#">
                            {{ $edit ? ' Update' : ' Save' }}
                        </button>
                    </div>
                </form>
            </x-modal>
            <!-- End Model ADD  -->

            <!-- Model Technician  -->
            <x-modal title="บันทึกการแจ้งซ่อม" wire:model="showModalTechnician" maxWidth="2xl" zIndex="20"
                closeModal="closeModal">

                <form wire:submit.prevent="{{ $edit ? ' updateWorkOrder' : ' saveWorkOrder' }}" id="formAddWeight">


                    @if (!empty($edit) && $edit == 1)
                        <div class="mx-4 mb-4">
                            <h1 class="text-lg font-semibold text-blue-800 font-anuphan">ข้อมูลการแจ้งซ่อม</h1>
                            <div class="mx-8 mt-4 text-lg font-semibold font-anuphan">
                                <h1 class="py-2">วันที่แจ้งซ่อม :  <span class="text-lg font-semibold text-blue-800 font-anuphan">{{
                                    \Carbon\Carbon::parse($created_at)->locale('th')->translatedFormat('d/m/Y')
                                    }}</span></h1>
                                <h1 class="py-2"> ชื่อผู้แจ้ง : <span class="text-lg font-semibold text-blue-800 font-anuphan">{{ $NameOfInformant }}</span> </h1>
                                <h1 class="py-2"> ชื่อเครื่อง :  <span class="text-lg font-semibold text-blue-800 font-anuphan">{{ $MachineName }} {{ $MachineCode }}</span></h1>
                                <h1 class="py-2"> รายละเอียด :  <span class="text-lg font-semibold text-blue-800 font-anuphan">{{ $Detail }}</span></h1>
                                <h1 class="py-2"> ที่อยู่ :  <span class="text-lg font-semibold text-blue-800 font-anuphan">{{ $Location }}</span></h1>
                                <h1 class="py-2"> โทร :  <span class="text-lg font-semibold text-blue-800 font-anuphan">{{ $Telephone }}</span></h1>


                            </div>
                        </div>
                    <hr>
                    <div class="mx-4 mt-2 text-lg font-semibold text-blue-800 font-anuphan">ข้อมูลสำหรับเจ้าหน้าที่
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="Number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                เลขที่เอกสาร
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-green-100 border border-green-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Number" name="Number" wire:model="Number" />
                            </div>
                        </div>
                        <div class="">
                            <label for="Status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                สถานะล่าสุด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-green-100 border border-green-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                <select type="text"
                                    class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Status" name="Status" wire:model="Status" required>
                                    <option disabled selected value="">
                                        เลือกสถานะ</option>
                                    <option value="1">รอดำเนินการ
                                    </option>
                                    <option value="2">กำลังดำเนินการ
                                    </option>
                                    <option value="3">ส่งซ่อมภายนอก
                                    </option>
                                    <option value="4">
                                        ดำเนินการเสร็จสิ้น</option>
                                    <option value="5">ยกเลิก</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="Technician"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                ช่างผู้ปฎิบัติงาน
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-green-100 border border-green-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <input type="text" placeholder=""
                                    class="font-semibold text-blue-700 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="Technician" name="Technician" wire:model="Technician" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-1 font-anuphan">
                        <div class="">
                            <label for="RepairReport"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                                บันทึกรายงานการซ่อม
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold bg-green-100 border border-green-200 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                </div>
                                <textarea type="text" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="RepairReport" name="RepairReport" wire:model="RepairReport">
                                </textarea>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- ปุ่ม submit -->
                    <div class="flex items-center justify-end px-4 py-3 mt-6 border-t gap-x-2 border-default-200">
                        <button type="submit" class="text-white btn bg-primary" href="#">
                            {{ $edit ? ' Update' : ' Save' }}
                        </button>
                    </div>
                </form>
            </x-modal>
            <!-- End Model Technician  -->

        </div>
    </div>
    <!-- Loading Indicator -->

</div>
