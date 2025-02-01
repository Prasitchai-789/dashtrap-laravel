<div>
    @include('layouts.root/page-title', ['subtitle' => 'Apps', 'title' => 'Test'])
    <div class="grid gap-5 mb-5 xl:grid-cols-4 md:grid-cols-2">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Daily</span>
                    <h5 class="truncate card-title">Cost per Unit</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">$17.21</h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">12.5%</span>
                        <i class="text-base i-tabler-arrow-up text-success ms-2"></i>
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center w-11/12 overflow-hidden rounded-full bg-primary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end card body-->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Per
                        Week</span>
                    <h5 class="truncate card-title">Market Revenue</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">$1875.54</h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">27.5%</span>
                        <i class="text-base i-tabler-arrow-up text-success ms-2"></i>
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center w-1/4 overflow-hidden rounded-full bg-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end card body-->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">Per
                        Month</span>
                    <h5 class="truncate card-title">Expenses</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">$784.62</h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">18.71%</span>
                        <i class="text-base i-tabler-arrow-up text-success ms-2"></i>
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center w-4/5 overflow-hidden rounded-full bg-warning" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end card body-->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <span class="px-1 py-0.5 text-[10px]/[1.25] font-semibold rounded text-success bg-success/20 float-end">All
                        Time</span>
                    <h5 class="truncate card-title">Daily Visits</h5>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-medium text-default-800">1,15,187</h2>
                    <span class="flex items-center">
                        <span class="text-sm text-default-400">57%</span>
                        <i class="text-base i-tabler-arrow-up text-success ms-2"></i>
                    </span>
                </div>

                <div class="flex w-full h-1.5 bg-default-200 rounded-full overflow-hidden shadow-sm">
                    <div class="flex flex-col justify-center w-1/4 overflow-hidden rounded-full bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end card body-->
        </div>
    </div>

    <div class="grid gap-5 mb-5 xl:grid-cols-3 md:grid-cols-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Last Month Sales</h4>
            </div>

            <div class="card-body">
                <div id="radial-chart" class="apex-charts"></div>
            </div>

            <div class="border-t border-dashed border-default-200 card-body">
                <div class="flex items-center justify-center gap-3">
                    <div class="flex items-center gap-1">
                        <div class="rounded-full size-3 bg-primary"></div>
                        <p class="text-sm text-default-700">Online</p>
                    </div>

                    <div class="flex items-center gap-1">
                        <div class="rounded-full size-3 bg-danger"></div>
                        <p class="text-sm text-default-700">Offlne</p>
                    </div>

                    <div class="flex items-center gap-1">
                        <div class="rounded-full size-3 bg-info"></div>
                        <p class="text-sm text-default-700">Retail</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Revenue</h5>
                </div>
                <div class="card-body">
                    <div id="line-chart" class="apex-charts"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 xl:grid-cols-2">
        <div class="overflow-hidden card">
            <div class="card-header">
                <h4 class="card-title">Product Inventory Overview</h4>
            </div>

            <div class="overflow-x-auto custom-scroll">
                <div class="inline-block min-w-full align-middle whitespace-nowrap">
                    <div class="overflow-hidden">
                        <table class="w-full text-sm text-left text-default-500">
                            <thead class="text-xs uppercase border-b text-default-700 bg-default-50">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" type="checkbox" class="rounded form-checkbox text-primary">
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">Product</th>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">Availability</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-default-50">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-1" type="checkbox" class="rounded form-checkbox text-primary">
                                        </div>
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <img class="rounded-full size-10" src="/images/media/img-1.jpg" alt="Wireless Headphones">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">Wireless Headphones</div>
                                            <div class="font-normal text-default-500">SKU: WH1234</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        Electronics
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        $99.99
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                            In Stock
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-default-50">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-2" type="checkbox" class="rounded form-checkbox text-primary">
                                        </div>
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <img class="rounded-full size-10" src="/images/media/img-2.jpg" alt="Smart Watch">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">Smart Watch</div>
                                            <div class="font-normal text-default-500">SKU: SW5678</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        Accessories
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        $149.99
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Out
                                            of Stock
                                        </div>
                                    </td>
                                </tr>
                                <tr class="border-b hover:bg-default-50">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-3" type="checkbox" class="rounded form-checkbox text-primary">
                                        </div>
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <img class="rounded-full size-10" src="/images/media/img-3.jpg" alt="Running Shoes">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">Running Shoes</div>
                                            <div class="font-normal text-default-500">SKU: RS9101</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        Footwear
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        $79.99
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                            In Stock
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-white hover:bg-default-50">
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-4" type="checkbox" class="rounded form-checkbox text-primary">
                                        </div>
                                    </td>
                                    <td class="flex items-center px-6 py-4">
                                        <img class="rounded-full size-10" src="/images/media/img-4.jpg" alt="Coffee Maker">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold">Coffee Maker</div>
                                            <div class="font-normal text-default-500">SKU: CM1122</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        Home Appliances
                                    </td>
                                    <td class="px-6 py-4 text-default-900 whitespace-nowrap">
                                        $49.99
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Out
                                            of Stock
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end card-->

        <div class="overflow-hidden card">
            <div class="card-header">
                <h4 class="card-title">Top Sallers List</h4>
            </div>

            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle whitespace-nowrap">
                    <table class="w-full text-sm text-left text-default-500">
                        <thead class="text-xs uppercase border-b text-default-700 bg-default-50 border-default-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">Company Name</th>
                                <th scope="col" class="px-6 py-3">CEO</th>
                                <th scope="col" class="px-6 py-3">Total Sales</th>
                                <th scope="col" class="px-6 py-3">Revenue</th>
                                <th scope="col" class="px-6 py-3">Share</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-default-200">
                            <tr class="transition-all hover:bg-default-50">
                                <td class="flex items-center px-6 py-4">
                                    <img class="rounded-full size-10" src="/images/companies/airbnb.png" alt="Company 1">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">Techlab LLC</div>
                                        <div class="font-normal text-default-500">Technology</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-base font-semibold">John Doe</div>
                                    <div class="font-normal text-default-500">john.doe@abc.com
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    45k
                                </td>
                                <td class="px-6 py-4">
                                    $900k
                                </td>
                                <td class="px-6 py-4">
                                    25%
                                </td>
                            </tr>
                            <tr class="transition-all hover:bg-default-50">
                                <td class="flex items-center px-6 py-4">
                                    <img class="rounded-full size-10" src="/images/companies/cisco.png" alt="Company 2">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">Visionary</div>
                                        <div class="font-normal text-default-500">Marketing</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-base font-semibold">Jane Smith</div>
                                    <div class="font-normal text-default-500">jane.smith@abc.com</div>
                                </td>
                                <td class="px-6 py-4">
                                    38k
                                </td>
                                <td class="px-6 py-4">
                                    $770k
                                </td>
                                <td class="px-6 py-4">
                                    21%
                                </td>
                            </tr>
                            <tr class="transition-all hover:bg-default-50">
                                <td class="flex items-center px-6 py-4">
                                    <img class="rounded-full size-10" src="/images/companies/amazon.png" alt="Company 3">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">Pinnacle</div>
                                        <div class="font-normal text-default-500">Software</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-base font-semibold">Alex Johnson</div>
                                    <div class="font-normal text-default-500">alex.johnson@abc.com
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    30k
                                </td>
                                <td class="px-6 py-4">
                                    $600k
                                </td>
                                <td class="px-6 py-4">
                                    18%
                                </td>
                            </tr>
                            <tr class="transition-all bg-white hover:bg-default-50">
                                <td class="flex items-center px-6 py-4">
                                    <img class="rounded-full size-10" src="/images/companies/apple.png" alt="Company 4">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">Global</div>
                                        <div class="font-normal text-default-500">Finance
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-base font-semibold">Emma Lee</div>
                                    <div class="font-normal text-default-500">emma.lee@abc.com
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    27k
                                </td>
                                <td class="px-6 py-4">
                                    $550k
                                </td>
                                <td class="px-6 py-4">
                                    15%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end card-->
    </div>

    <button type="button" class="text-white btn bg-primary">Primary</button>

    <div class="flex flex-col gap-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Input</h4>
            </div>
            <div class="p-6">
                <div class="grid gap-6 lg:grid-cols-2">

                    <div>
                        <label for="simpleinput" class="inline-block mb-2 text-sm font-medium text-default-800">Text</label>
                        <input type="text" id="simpleinput" class="form-input">
                    </div>

                    <div>
                        <label for="example-email" class="inline-block mb-2 text-sm font-medium text-default-800">Email</label>
                        <input type="email" id="example-email" name="example-email" class="form-input" placeholder="Email">
                    </div>

                    <div>
                        <label for="example-password" class="inline-block mb-2 text-sm font-medium text-default-800">Password</label>
                        <input type="password" id="example-password" class="form-input" value="password">
                    </div>

                    <div>
                        <label for="password" class="inline-block mb-2 text-sm font-medium text-default-800">Show/Hide
                            Password</label>
                        <div class="flex">
                            <input type="password" id="password" class="form-input" placeholder="Enter your password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye">*</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="example-palaceholder" class="inline-block mb-2 text-sm font-medium text-default-800">Placeholder</label>
                        <input type="text" id="example-palaceholder" class="form-input" placeholder="placeholder">
                    </div>

                    <div>
                        <label for="example-readonly" class="inline-block mb-2 text-sm font-medium text-default-800">Readonly</label>
                        <input type="text" id="example-readonly" class="form-input" readonly="" value="Readonly value">
                    </div>

                    <div>
                        <label for="example-disable" class="inline-block mb-2 text-sm font-medium text-default-800">Disabled</label>
                        <input type="text" class="form-input" id="example-disable" disabled="" value="Disabled value">
                    </div>

                    <div>
                        <label for="example-date" class="inline-block mb-2 text-sm font-medium text-default-800">Date</label>
                        <input class="form-input" id="example-date" type="date" name="date">
                    </div>

                    <div>
                        <label for="example-month" class="inline-block mb-2 text-sm font-medium text-default-800">Month</label>
                        <input class="form-input" id="example-month" type="month" name="month">
                    </div>

                    <div>
                        <label for="example-time" class="inline-block mb-2 text-sm font-medium text-default-800">Time</label>
                        <input class="form-input" id="example-time" type="time" name="time">
                    </div>

                    <div>
                        <label for="example-week" class="inline-block mb-2 text-sm font-medium text-default-800">Week</label>
                        <input class="form-input" id="example-week" type="week" name="week">
                    </div>

                    <div>
                        <label for="example-number" class="inline-block mb-2 text-sm font-medium text-default-800">Number</label>
                        <input class="form-input" id="example-number" type="number" name="number">
                    </div>

                    <div>
                        <label for="example-color" class="inline-block mb-2 text-sm font-medium text-default-800">Color</label>
                        <input class="h-10 form-input" id="example-color" type="color" name="color" value="#1E85FF">
                    </div>

                    <div>
                        <label for="example-select" class="inline-block mb-2 text-sm font-medium text-default-800">Input
                            Select</label>
                        <select class="form-select" id="example-select">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>

                    <div>
                        <label for="example-multiselect" class="inline-block mb-2 text-sm font-medium text-default-800">Multiple
                            Select</label>
                        <select id="example-multiselect" multiple class="form-input">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
            </div>
        </div> <!-- end card -->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Input Group</h4>
            </div>
            <div class="p-6">
                <div class="grid gap-6 lg:grid-cols-2">

                    <div class="mb-5">
                        <div class="flex">
                            <div class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                @
                            </div>
                            <input type="text" placeholder="Username" class="form-input rounded-s-none" />
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="flex">
                            <input type="text" placeholder="Recipient's username" class="form-input rounded-e-none" />
                            <div class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-r-md border-s-0">
                                @example.com
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="flex">
                            <div class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                https://
                            </div>
                            <input id="url" type="text" placeholder="example.com/users/" class="form-input rounded-s-none" />
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="flex">
                            <div class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-s-md border-e-0">
                                $
                            </div>
                            <input type="text" placeholder="" class="rounded-none form-input" />
                            <div class="flex items-center justify-center px-3 font-semibold border border-default-200 bg-default-100 rounded-e-md border-s-0">
                                .00
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex -space-x-px rounded-md shadow-sm">
                            <span class="inline-flex items-center px-4 text-sm border rounded-s border-default-200 bg-default-50 text-default-500">Default</span>
                            <input type="text" class="form-input rounded-s-none">
                        </div>
                    </div>

                    <div>
                        <div class="rounded-md shadow-sm sm:flex">
                            <input type="text" class="form-input">
                            <span class="py-2.5 px-4 inline-flex items-center min-w-fit w-full border border-default-200 bg-default-50 text-sm text-default-500 -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:w-auto sm:first:rounded-l-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-tr-none sm:last:rounded-bl-none sm:last:rounded-r-lg">
                                <svg class="hidden w-4 h-4 sm:block text-default-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z">
                                </svg>
                                <svg class="w-4 h-4 mx-auto sm:hidden text-default-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z">
                                </svg>
                            </span>
                            <input type="text" class="form-input">
                        </div>
                    </div>


                    <div>
                        <label for="simpleinput" class="inline-block mb-2 text-sm font-medium text-default-800">Email
                            Address</label>
                        <div class="relative">
                            <input type="email" id="leading-icon" name="leading-icon" class="form-input ps-11" placeholder="you@site.com">
                            <div class="absolute inset-y-0 z-20 flex items-center start-4">
                                <i class="i-tabler-mail] text-lg text-default-400"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="simpleinput" class="inline-block mb-2 text-sm font-medium text-default-800">Text</label>
                        <div class="relative">
                            <input type="text" id="input-with-leading-and-trailing-icon" name="input-with-leading-and-trailing-icon" class="px-8 form-input" placeholder="0.00">
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none start-4">
                                <span class="text-default-500">$</span>
                            </div>
                            <div class="absolute inset-y-0 z-20 flex items-center pointer-events-none end-4">
                                <span class="text-default-500">USD</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="simpleinput" class="inline-block mb-2 text-sm font-medium text-default-800">Text</label>
                        <div class="flex rounded-md shadow-sm">
                            <div class="inline-flex items-center px-4 border min-w-fit rounded-l-md border-e-0 border-default-200 bg-default-50">
                                <span class="text-sm text-default-500">http://</span>
                            </div>
                            <input type="text" name="input-with-add-on-url" id="input-with-add-on-url" class="form-input" placeholder="www.example.com">
                        </div>
                    </div>

                    <div>
                        <label for="simpleinput" class="inline-block mb-2 text-sm font-medium text-default-800">Text</label>
                        <div class="flex rounded-md shadow-sm">
                            <div class="inline-flex items-center px-4 border min-w-fit rounded-l-md border-e-0 border-default-200 bg-default-50">
                                <span class="text-sm text-default-500">$</span>
                            </div>
                            <div class="inline-flex items-center px-4 border min-w-fit border-e-0 border-default-200 bg-default-50">
                                <span class="text-sm text-default-500">0.00</span>
                            </div>
                            <input type="text" id="leading-multiple-add-on" name="inline-add-on" class="form-input" placeholder="www.example.com">
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- end card -->
    </div>

    <div class="card-body">
        <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-6 *:flex *:items-center *:gap-3 *:text-default-700 hover:*:text-primary *:transition-all *:duration-200">
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-html5"></i>
                <span class="">brand-html5</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-css3"></i>
                <span class="">brand-css3</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-nodejs"></i>
                <span class="">brand-nodejs</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-python"></i>
                <span class="">brand-python</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-sketch"></i>
                <span class="">brand-sketch</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-facebook"></i>
                <span class="">brand-facebook</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-slack"></i>
                <span class="">brand-slack</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-dribbble"></i>
                <span class="">brand-dribbble</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-github"></i>
                <span class="">brand-github</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-git"></i>
                <span class="">brand-git</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-gitlab"></i>
                <span class="">brand-gitlab</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-figma"></i>
                <span class="">brand-figma</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-tailwind"></i>
                <span class="">brand-tailwind</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-linkedin"></i>
                <span class="">brand-linkedin</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-vite"></i>
                <span class="">brand-vite</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-react"></i>
                <span class="">brand-react</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-nextjs"></i>
                <span class="">brand-nextjs</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-vue"></i>
                <span class="">brand-vue</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-nuxt"></i>
                <span class="">brand-nuxt</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-angular"></i>
                <span class="">brand-angular</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-behance"></i>
                <span class="">brand-behance</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-android"></i>
                <span class="">brand-android</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-bing"></i>
                <span class="">brand-bing</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-codepen"></i>
                <span class="">brand-codepen</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-npm"></i>
                <span class="">brand-npm</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-yarn"></i>
                <span class="">brand-yarn</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-php"></i>
                <span class="">brand-php</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-laravel"></i>
                <span class="">brand-laravel</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-symfony"></i>
                <span class="">brand-symfony</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-cakephp"></i>
                <span class="">brand-cakephp</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-apple"></i>
                <span class="">brand-apple</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-pinterest"></i>
                <span class="">brand-pinterest</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-tabler"></i>
                <span class="">brand-tabler</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-adobe"></i>
                <span class="">brand-adobe</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-x"></i>
                <span class="">brand-x</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-twitter"></i>
                <span class="">brand-twitter</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-redux"></i>
                <span class="">brand-redux</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-chrome"></i>
                <span class="">brand-chrome</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-google"></i>
                <span class="">brand-google</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-google-play"></i>
                <span class="">brand-google-play</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-google-drive"></i>
                <span class="">brand-google-drive</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-google-home"></i>
                <span class="">brand-google-home</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-google-maps"></i>
                <span class="">brand-google-maps</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-google-photos"></i>
                <span class="">brand-google-photos</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-google-analytics"></i>
                <span class="">brand-google-analytics</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-yandex"></i>
                <span class="">brand-yandex</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-edge"></i>
                <span class="">brand-edge</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-loom"></i>
                <span class="">brand-loom</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-blender"></i>
                <span class="">brand-blender</span>
            </span>
            <span class="inline-flex items-center gap-4 text-default-600">
                <i class="text-2xl i-tabler-brand-openai"></i>
                <span class="">brand-openai</span>
            </span>
        </div>
    </div>

    <div class="card-body">
        <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-6 *:flex *:items-center *:gap-3 *:text-default-700 hover:*:text-primary *:transition-all *:duration-200">

            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">home</i><span>home</span>
            </div>

            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded fill-1">home</i><span>home (fill
                    Icon)</span>
            </div>

            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl transition-all material-symbols-rounded hover:fill-1">home</i><span>home
                    (Icon Hover)</span>
            </div>

            <div class="inline-flex items-center gap-4 text-default-60 group">
                <i class="text-2xl transition-all material-symbols-rounded group-hover:fill-1">home</i><span>home
                    (Group Hover)</span>
            </div>

            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">search</i><span>search</span>
            </div>

            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">menu</i><span>menu</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">close</i><span>close</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">settings</i><span>settings</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">done</i><span>done</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">expand_more</i><span>expand_more</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">check_circle</i><span>check_circle

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">favorite</i><span>favorite</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">add</i><span>add</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">delete</i><span>delete</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">arrow_back</i><span>arrow_back</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">logout</i><span>logout</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">chevron_right</i><span>chevron_right

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">star</i><span>star</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">arrow_forward_ios</i><span>arrow_forward_ios

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">add_circle</i><span>add_circle</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">arrow_back_ios</i><span>arrow_back_ios

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">cancel</i><span>cancel</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">file_download</i><span>file_download

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">arrow_forward</i><span>arrow_forward

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">arrow_drop_down</i><span>arrow_drop_down

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">more_vert</i><span>more_vert</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">check</i><span>check</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">check_box</i><span>check_box</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">toggle_on</i><span>toggle_on</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">open_in_new</i><span>open_in_new</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">grade</i><span>grade</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">login</i><span>login</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">check_box_outline_blank</i><span>check_box_outline_blank

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">refresh</i><span>refresh</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">chevron_left</i><span>chevron_left

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">expand_less</i><span>expand_less</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">more_horiz</i><span>more_horiz</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">radio_button_unchecked</i><span>radio_button_unchecked

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">file_upload</i><span>file_upload</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">arrow_right_alt</i><span>arrow_right_alt

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">radio_button_checked</i><span>radio_button_checked

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">apps</i><span>apps</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">remove</i><span>remove</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">download</i><span>download</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">delete_forever</i><span>delete_forever

                </span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">toggle_off</i><span>toggle_off</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">bolt</i><span>bolt</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">filter_list</i><span>filter_list</span>
            </div>
            <div class="inline-flex items-center gap-4 text-default-60">
                <i class="text-2xl material-symbols-rounded">arrow_upward</i><span>arrow_upward</span>
            </div>
        </div>
    </div>
</div>

