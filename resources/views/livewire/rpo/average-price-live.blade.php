<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'ราคาเฉลี่ย'])

    <div class="page-header">
        <div class="page-header">
            <div class="p-6 bg-white rounded-lg shadow-lg">

                <div class="flex items-center justify-end mb-4">
                    <!-- ส่วนของปุ่มต่างๆ -->
                        <button type="button"
                            class="px-4 py-2 text-sm text-white transition rounded-lg bg-primary hover:bg-blue-500 hover:shadow-lg hover:scale-105"
                            wire:click='openModal'>
                            CREATE
                        </button>
                </div>
                <div class="flex items-center justify-center mb-2">
                    <h1 class="text-2xl font-bold font-anuphan">ราคารับซื้อรายวัน สินค้าผลปาล์มน้ำมันทั้งทะลาย น้ำหนักมากกว่า 15 กก. ขึ้นไป </h1>
                 </div>


                <!-- Table -->
                <div class="">
                    <div class="overflow-x-auto rounded-lg font-anuphan">
                        <table class="w-full border border-collapse">
                            <thead class="text-center bg-gray-200">
                                <tr class="border">
                                    <th class="p-3 border">วันที่</th>
                                    <th class="p-3 text-white bg-blue-500 border">หน้าป้าย</th>
                                    <th class="p-3 text-white bg-blue-500 border">บริษัท อีสานพัฒนาอุตสาหกรรมปาล์ม จำกัด</th>
                                    <th class="p-3 text-white bg-red-300 border">บริษัท สุขสมบูรณ์ สกลนคร</th>
                                    <th class="p-3 text-white bg-green-400 border">บริษัท แอ๊บโซลูท ปาล์ม จำกัด</th>
                                    <th class="p-3 text-white bg-red-300 border">บริษัท สุขสมบูรณ์ ชลบุรี</th>
                                    <th class="p-3 border">บริษัท แสงศิริ น้ำมันปาล์ม จำกัด</th>
                                    <th class="p-3 border">บริษัท ศรีเจริญปาล์มออยล์ จำกัด</th>
                                    <th class="p-3 border">บริษัท วิจิตรภัณฑ์สวนปาล์ม จำกัด</th>
                                    <th class="p-3 border">บริษัท ยูนิวานิจ จำกัด</th>
                                    <th class="p-3 border">บริษัท ชุมนุมสหกรณ์ชาวสวน จำกัด</th>
                                    <th class="p-3 text-center border">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($averagePrices as $avgPrice)

                                <tr class="text-gray-800 hover:bg-gray-100 hover:text-primary">
                                    <td class="p-2 font-bold text-center border">{{
                                        \Carbon\Carbon::parse($avgPrice->created_at)->locale('th')->translatedFormat('d/m/Y')
                                        }}</td>
                                    <td class="p-2 font-bold text-center border bg-blue-50">{{ number_format($avgPrice->price_font, 2, '.', ',') }}
                                    </td>
                                    <td class="p-2 font-bold text-center bg-blue-100 border">{{ number_format($avgPrice->price_isp, 2, '.', ',') }}
                                    </td>
                                    <td class="p-2 font-bold text-center bg-red-100 border">
                                        {{ isset($avgPrice->price_ssg_sakon) ? number_format($avgPrice->price_ssg_sakon, 2, '.', ',') : '' }}
                                    </td>
                                    <td class="p-2 font-bold text-center bg-green-200 border">
                                        {{ isset($avgPrice->price_app) ? number_format($avgPrice->price_app, 2, '.', ',') : '' }}
                                    </td>
                                    <td class="p-2 font-bold text-center bg-red-100 border">
                                        {{ isset($avgPrice->price_ssg_chon) ? number_format($avgPrice->price_ssg_chon, 2, '.', ',') : '' }}
                                    </td>
                                    <td class="p-2 font-bold text-center border">
                                        {{ isset($avgPrice->price_sang) ? number_format($avgPrice->price_sang, 2, '.', ',') : '' }}
                                    </td>
                                    <td class="p-2 font-bold text-center border">
                                        {{ isset($avgPrice->price_see) ? number_format($avgPrice->price_see, 2, '.', ',') : '' }}
                                    </td>
                                    <td class="p-2 font-bold text-center border">
                                        {{ isset($avgPrice->price_wijit) ? number_format($avgPrice->price_wijit, 2, '.', ',') : '' }}
                                    </td>
                                    <td class="p-2 font-bold text-center border">
                                        {{ isset($avgPrice->price_uni) ? number_format($avgPrice->price_uni, 2, '.', ',') : '' }}
                                    </td>
                                    <td class="p-2 font-bold text-center border">
                                        {{ isset($avgPrice->price_chaw) ? number_format($avgPrice->price_chaw, 2, '.', ',') : '' }}
                                    </td>

                                    <td class="p-2 text-center border">
                                        <a href="#" wire:click='confirmEdit({{ $avgPrice->id  }})'>
                                            <i class="me-4 fa-regular fa-pen-to-square text-warning hover:text-yellow-700 hover:scale-110"
                                                style="font-size: 16px; vertical-align: middle;"></i>
                                        </a>
                                        @can('delete user')
                                        <a href="#" wire:click='confirmDelete({{ $avgPrice->id }})'>
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
                            {{ $averagePrices->links('pagination::tailwind') ?? '' }}
                        </div>
                    </div>
                </div>
                <!-- End Table -->
            </div>


            <!-- Model ADD  -->
            <x-modal title="บันทึกข้อมูลราคาเฉลี่ย" wire:model="showModal" maxWidth="2xl" zIndex="20" closeModal="closeModal">
                <form class="form " wire:submit.prevent="{{ $edit ? 'updateAvgPrice' : 'saveAvgPrice' }}" id="formAddPrice">

                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">

                        <div class="">
                            <label for="created_at"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                วันที่
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </div>
                                <input type="date" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="created_at" name="created_at" wire:model="created_at" required  />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">

                        <div class="">
                            <label for="price_font"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                ราคาหน้าป้าย
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_font" name="price_font" wire:model="price_font" required step="0.01" min="0" />
                            </div>
                        </div>
                        <div class="">
                            <label for="price_isp"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท อีสานพัฒนาอุตสาหกรรมปาล์ม จำกัด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_isp" name="price_isp" wire:model="price_isp" required step="0.01" min="0" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">

                        <div class="">
                            <label for="price_ssg_sakon"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท สุขสมบูรณ์ สกลนคร
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_ssg_sakon" name="price_ssg_sakon" wire:model="price_ssg_sakon" required step="0.01" min="0" />
                            </div>
                        </div>
                        <div class="">
                            <label for="price_app"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท แอ๊บโซลูท ปาล์ม จำกัด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_app" name="price_app" wire:model="price_app" required step="0.01" min="0" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">

                        <div class="">
                            <label for="price_ssg_chon"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท สุขสมบูรณ์ ชลบุรี
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_ssg_chon" name="price_ssg_chon" wire:model="price_ssg_chon" required step="0.01" min="0" />
                            </div>
                        </div>
                        <div class="">
                            <label for="price_sang"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท แสงศิริ น้ำมันปาล์ม จำกัด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_sang" name="price_sang" wire:model="price_sang" required step="0.01" min="0" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">
                        <div class="">
                            <label for="price_see"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท ศรีเจริญปาล์มออยล์ จำกัด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_see" name="price_see" wire:model="price_see" required step="0.01" min="0" />
                            </div>
                        </div>
                        <div class="">
                            <label for="price_wijit"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท วิจิตรภัณฑ์สวนปาล์ม จำกัด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_wijit" name="price_wijit" wire:model="price_wijit" required step="0.01" min="0" />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 m-4 mb-3 md:grid-cols-2 font-anuphan">

                        <div class="">
                            <label for="price_uni"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท ยูนิวานิจ จำกัด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_uni" name="price_uni" wire:model="price_uni" required step="0.01" min="0" />
                            </div>
                        </div>
                        <div class="">
                            <label for="price_chaw"
                                class="block mb-2 text-sm font-medium text-default-600 dark:text-white font-prompt">
                                บริษัท ชุมนุมสหกรณ์ชาวสวน จำกัด
                            </label>
                            <div class="flex">
                                <div
                                    class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                                <input type="number" placeholder=""
                                    class="font-semibold text-blue-900 form-input rounded-s-none focus:ring-blue-500 focus:border-blue-500"
                                    id="price_chaw" name="price_chaw" wire:model="price_chaw" required step="0.01" min="0" />
                            </div>
                        </div>

                    </div>

                    {{-- <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-e-0 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                          </svg>
                        </span>
                        <input type="text" id="website-admin" class="rounded-s-none rounded-md bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-100 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="elonmusk">
                      </div> --}}

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
