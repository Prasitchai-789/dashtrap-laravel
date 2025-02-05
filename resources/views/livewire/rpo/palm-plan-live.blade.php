<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'แผนการรับซื้อผลปาล์ม'])

    <div class="page-header">
        <div class="page-header">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <div class="flex items-center justify-end mb-2">
                    <!-- ส่วนของปุ่มต่างๆ -->
                        <button type="button"
                            class="px-4 py-2 text-sm text-white transition rounded-lg bg-primary hover:bg-blue-500"
                            wire:click=openModal @click="show = true">
                            CREATE
                        </button>
                        <button type="button"
                            class="px-4 py-2 text-sm text-white transition rounded-lg bg-primary hover:bg-blue-500"
                            wire:click=notify ">
                            send
                        </button>
                </div>


                <!-- Table -->
                <div class="">
                    <div class="overflow-x-auto font-anuphan">
                        <table class="w-full border border-collapse">
                            <thead class="text-center bg-gray-200">
                                <tr class="border">
                                    <th class="p-3 border">วันที่</th>
                                    <th class="p-3 border">จำนวนรายการ</th>
                                    <th class="p-3 border">แผนรับเข้า</th>
                                    <th class="p-3 border">รับจริง</th>
                                    <th class="p-3 border">เปอร์เซ็นต์</th>
                                    <th class="p-3 text-center border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($palmPlans as $palmPlans)
                                <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                    <td class="p-3 text-center border">{{
                                        \Carbon\Carbon::parse($palmPlans->created_at)->locale('th')->translatedFormat('d/m/Y')
                                        }}</td>
                                    <td class="p-3 text-center border">{{ number_format($palmPlans->list_plan, 0, '.', ',') }}
                                    </td>
                                    <td class="p-3 border text-end">{{ number_format($palmPlans->palm_plan, 0, '.', ',') }} kg.
                                    </td>
                                    <td class="p-3 font-bold border text-end">
                                        {{ isset($palmPlans->actual_plan) ? number_format($palmPlans->actual_plan, 0, '.', ',') : '' }} kg.
                                    </td>
                                    <td class="p-3 font-bold border text-end">
                                        {{ isset($palmPlans->per_plan) ? number_format($palmPlans->per_plan, 2, '.', ',') : '' }} %
                                    </td>

                                    <td class="p-3 text-center border">
                                        <div class="relative text-center " x-data="{ open: false }">
                                            <a href="#" class="text-gray-500 hover:text-gray-900 focus:outline-none"
                                                @click="open = !open">
                                                <div class="flex items-center justify-center ">
                                                    <p
                                                        class="text-lg font-medium text-gray-900 dark:text-white hover:text-xl">
                                                        ...</p>
                                                </div>
                                            </a>
                                            <!-- Dropdown menu -->
                                            <ul class="absolute right-0 z-10 w-48 mt-2 bg-white border border-gray-200 rounded-md shadow-lg"
                                                x-show="open" @click.away="open = false" x-transition>
                                                <li>
                                                    <a href="#" wire:click='confirmEdit({{ $palmPlans->id }})'
                                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-start">
                                                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit
                                                    </a>
                                                </li>
                                                @can('delete user')
                                                <li>
                                                    <a href="#" wire:click='confirmDelete({{ $palmPlans->id }})'
                                                        class="block px-4 py-2 text-red-500 hover:bg-gray-100 text-start">
                                                        <i class="fa-solid fa-trash me-2"></i> Delete
                                                    </a>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex mt-4">
                            {{-- {{ $webappPOInvs->links() ?? '' }} --}}
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>


            <!-- Model ADD  -->
            <x-modal title="แผนการรับซื้อผลปาล์ม" wire:model="showModal" maxWidth="md" zIndex="20" closeModal="closeModal">
                <form class="form " wire:submit.prevent="{{ $edit ? 'updatePlan' : 'savePalm' }}" id="formAddPlan">

                    <div class="grid grid-cols-1 gap-4 m-4 mb-6 md:grid-cols-1 font-anuphan">
                        <div class="grid items-center grid-cols-4 gap-6">
                            <label for="list_plan" class="inline-block text-sm font-medium text-default-800">จำนวนรายการ</label>
                            <div class="md:col-span-3">
                                <input type="text" class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="list_plan" name="list_plan" wire:model="list_plan" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-6 md:grid-cols-1 font-anuphan">
                        <div class="grid items-center grid-cols-4 gap-6">
                            <label for="palm_plan" class="inline-block text-sm font-medium text-default-800">แผนรับเข้า (kg.)</label>
                            <div class="md:col-span-3">
                                <input type="text" class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="palm_plan" name="palm_plan" wire:model="palm_plan" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 m-4 mb-6 md:grid-cols-1 font-anuphan">
                        <div class="grid items-center grid-cols-4 gap-6">
                            <label for="actual_plan" class="inline-block text-sm font-medium text-default-800">ปริมาณรับเข้าจริง (kg.)</label>
                            <div class="md:col-span-3">
                                <input type="text" class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="actual_plan" name="actual_plan" wire:model="actual_plan" placeholder="">
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
</div>

