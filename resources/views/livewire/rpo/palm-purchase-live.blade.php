<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'รับซื้อผลปาล์ม'])

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
                <div class="overflow-x-auto font-anuphan">
                    <table class="w-full border border-collapse">
                        <thead class="text-center bg-gray-200">
                            <tr class="border">
                                <th class="p-3 border">ลำดับ</th>
                                <th class="p-3 border">วันที่</th>
                                <th class="p-3 border">รหัสบิล</th>
                                <th class="p-3 border">ประเภทรถ</th>
                                <th class="p-3 border">ทะเบียนรถ</th>
                                <th class="p-3 border">ชื่อลูกค้า</th>
                                <th class="p-3 border">เข้า</th>
                                <th class="p-3 border">ออก</th>
                                <th class="p-3 border">สุทธิ</th>
                                <th class="p-3 border">เกรด</th>
                                <th class="p-3 border">เจือบน</th>
                                <th class="p-3 text-center border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($webappPOInvs as $webappPOInv)
                            <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                <td class="p-3 text-center border">{{ ($webappPOInvs->firstItem() + $loop->index) }}
                                </td>
                                <td class="p-3 border">{{
                                    \Carbon\Carbon::parse($webappPOInv->DocuDate)->locale('th')->translatedFormat('d/m/Y')
                                    }}</td>
                                <td class="p-3 border">{{$webappPOInv->BillID}}</td>
                                <td class="p-3 border">{{$webappPOInv->TypeCarID}}</td>
                                <td class="p-3 border">{{$webappPOInv->VendorCarID}}</td>
                                <td class="p-3 border">
                                    {{ optional($webappPOInv->empVendor)->VendorTitle ?
                                    optional($webappPOInv->empVendor)->VendorTitle .
                                    optional($webappPOInv->empVendor)->VendorName :
                                    optional($webappPOInv->empVendor)->VendorName }}
                                </td>
                                <td class="p-3 border text-end">{{ number_format($webappPOInv->GoodIB, 0, '.', ',') }}
                                </td>
                                <td class="p-3 border text-end">{{ number_format($webappPOInv->GoodOB, 0, '.', ',') }}
                                </td>
                                <td class="p-3 font-bold border text-end">{{ number_format($webappPOInv->GoodNet, 0,
                                    '.', ',') }}</td>
                                <td class="p-3 text-center border">{{$webappPOInv->Grade}}</td>
                                <td class="p-3 text-center border">{{$webappPOInv->Impurity}}</td>

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
                                                <a href="#" wire:click='confirmEdit({{ $webappPOInv->POInvID }})'
                                                    data-bs-toggle="modal" data-hs-overlay="#modal-palm-purchase"
                                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-start">
                                                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit
                                                </a>
                                            </li>
                                            @can('delete user')
                                            <li>
                                                <a href="#" wire:click='confirmDelete({{ $webappPOInv->POInvID }})'
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
                        {{ $webappPOInvs->links() ?? '' }}
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>

        <!-- Model ADD Palm -->
        <x-modal title="ข้อมูลการผลิต" wire:model="showModal" maxWidth="4xl" zIndex="20">
            <form class="form " wire:submit.prevent="{{ $edit ? 'updatePalmPurchase' : 'savePalmPurchase' }}"
                id="formPalmPurchase">
                <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-3 font-anuphan">
                    <div class="">
                        <label for="BillID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เลขที่บิล
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="BillID" name="BillID" wire:model="BillID" required />
                        </div>
                    </div>

                    <div class="">
                        <label for="Price1"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ราคา
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-money-bill"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Price1" name="Price1" wire:model="Price1" readonly />
                        </div>
                    </div>
                    <div class="Scaler">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ตาชั่ง
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-inbox"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Scaler" name="Scaler" wire:model="Scaler" readonly />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-2 font-anuphan">

                    <div>
                        <label for="VendorCode"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            รหัสลูกค้า
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-hashtag"></i>
                            </div>

                            <input type="text" id="VendorCode" name="VendorCode" wire:model="VendorCode"
                                list="vendorCodes" wire:change="getVendorName"
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                required placeholder="เลือก...">
                            <datalist id="vendorCodes">
                                @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->VendorCode }}">{{ $vendor->VendorName }}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div>
                        <label for="VendorName"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ชื่อลูกค้า
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <input type="text"
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="VendorName" name="VendorName" wire:model="VendorName" readonly />
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-2 font-anuphan">

                    <div class="">
                        <label for="VendorCarID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ทะเบียนรถ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-truck-pickup"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="VendorCarID" name="VendorCarID" wire:model="VendorCarID" required />
                        </div>
                    </div>

                    <div>
                        <label for="TypeCarID"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            ประเภทรถ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-truck-pickup"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="TypeCarID" name="TypeCarID" wire:model="TypeCarID" required>
                                <option selected value="">เลือก...</option>
                                @foreach ($POInvDTCars as $POInvDTCar)
                                <option value="{{ $POInvDTCar->TypeCarID }}">
                                    {{ $POInvDTCar->TypeCarName }}
                                </option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-3 font-anuphan">

                    <div class="">
                        <label for="GoodIB"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            น้ำหนักเข้า
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-angle-right"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="GoodIB" name="GoodIB" wire:model="GoodIB" wire:blur='calculateNet' required />


                        </div>
                        @if ($errors->has('GoodIB'))
                        <span class="text-sm text-red-500">{{ $errors->first('GoodIB') }}</span>
                        @endif
                    </div>

                    <div class="">
                        <label for="GoodOB"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            น้ำหนักออก
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-angle-left"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="GoodOB" name="GoodOB" wire:model="GoodOB" wire:blur='calculateNet' required />

                        </div>
                        @if ($errors->has('GoodOB'))
                        <span class="text-sm text-red-500">{{ $errors->first('GoodOB') }}</span>
                        @endif
                    </div>

                    <div class="">
                        <label for="GoodNet"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            น้ำหนักสุทธิ
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-cart-plus"></i>
                            </div>
                            <input type="text" placeholder=""
                                class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="GoodNet" name="GoodNet" wire:model="GoodNet" readonly />
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-4 m-4 mb-2 md:grid-cols-4 font-anuphan">
                    <div>
                        <label for="Grade"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            เกรด
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-spell-check"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Grade" name="Grade" wire:model="Grade" required>
                                <option selected value="">เลือก...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>

                            </select>
                        </div>
                    </div>
                    ้
                    <div>
                        <label for="Impurity"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-prompt">
                            สิ่งเจือปน
                        </label>
                        <div class="flex">
                            <div
                                class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <select type="text"
                                class="font-semibold text-blue-900 form-select rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                id="Impurity" name="Impurity" wire:model="Impurity" required>
                                <option selected value="">เลือก...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>

                            </select>
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
        <!-- End Model ADD Palm -->

    </div>
</div>
