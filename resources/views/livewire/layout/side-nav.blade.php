
    <!-- Start Sidebar -->
<aside id="app-menu"
class="hs-overlay fixed inset-y-0 start-0 z-60 hidden w-sidenav min-w-sidenav bg-skyline overflow-y-auto -translate-x-full transform transition-all duration-200 hs-overlay-open:translate-x-0 lg:bottom-0 lg:end-auto lg:z-30 lg:block lg:translate-x-0 rtl:translate-x-full rtl:hs-overlay-open:translate-x-0 rtl:lg:translate-x-0 print:hidden [--body-scroll:true] [--overlay-backdrop:true] lg:[--overlay-backdrop:false]">

<div class="flex flex-col h-full">
    <!-- Sidenav Logo -->
    <div class="sticky top-0 flex items-center justify-between px-6 h-topbar">
        <a href="/">
            <img src="/images/logo-isp-light.png" alt="logo" class="flex h-8">
        </a>
    </div>

    <div class="p-4 h-[calc(100%-theme('spacing.topbar'))] flex-grow" data-simplebar>
        <!-- Menu -->
        <ul class="flex flex-col w-full gap-1 admin-menu hs-accordion-group">
            <li class="px-3 py-2 text-sm font-medium text-default-400">Apps</li>

            <li class="menu-item">
                <a class="group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5"
                    href="{{ route('test') }}">
                    <i class="text-2xl i-ph-gauge-duotone"></i>
                    Test
                </a>
            </li>

            {{-- <li class="menu-item">
                <a class="group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5"
                    href="{{ route('dashboard') }}">
                    <i class="text-2xl i-ph-calendar-duotone"></i>
                    Dashboard
                </a>
            </li> --}}



            <li class="px-3 py-2 text-sm font-medium text-default-400">Departments</li>
            @can('view RPO')
            <li class="menu-item hs-accordion font-prompt">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5 hs-accordion-active:bg-default-100/5 hs-accordion-active:text-default-100">
                    <span class="text-2xl i-ph-layout-duotone"></span>
                    <span class="menu-text"> ฝ่ายจัดซื้อปาล์ม </span>
                    <span class="menu-arrow"></span>
                </a>

                <div id="sidenavLevel"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-1 space-y-1">
                        <li class="menu-item">
                            <a href="{{ route('palm-purchase') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">รับซื้อผลปาล์ม</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('sales-product') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">รายการขายสินค้า</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('palm-plan') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">แผนการรับซื้อ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @can('create MAR')
            <li class="menu-item hs-accordion font-prompt">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5 hs-accordion-active:bg-default-100/5 hs-accordion-active:text-default-100">
                    <span class="text-2xl i-ph-layout-duotone"></span>
                    <span class="menu-text"> ฝ่ายขายและการตลาด </span>
                    <span class="menu-arrow"></span>
                </a>

                <div id="sidenavLevel"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-1 space-y-1">
                        <li class="menu-item">
                            <a href="{{ route('sales-plan') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">แผนการโหลดสินค้า</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @can('view ACC')
            <li class="menu-item hs-accordion font-prompt">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5 hs-accordion-active:bg-default-100/5 hs-accordion-active:text-default-100">
                    <span class="text-2xl i-ph-layout-duotone"></span>
                    <span class="menu-text"> ฝ่ายบัญชีและการเงิน </span>
                    <span class="menu-arrow"></span>
                </a>

                <div id="sidenavLevel"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-1 space-y-1">
                        <li class="menu-item">
                            <a href="{{ route('purchase-price') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">บันทึกราคารับซื้อ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @can('view HRE')
            <li class="menu-item hs-accordion font-prompt">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5 hs-accordion-active:bg-default-100/5 hs-accordion-active:text-default-100">
                    <span class="text-2xl i-ph-layout-duotone"></span>
                    <span class="menu-text"> ฝ่ายทรัพยากรบุคคล </span>
                    <span class="menu-arrow"></span>
                </a>

                <div id="sidenavLevel"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-1 space-y-1">
                        <li class="menu-item">
                            <a href="{{ route('employee') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">ข้อมูลพนักงาน</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @can('view ALL')
            <li class="menu-item hs-accordion font-prompt">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5 hs-accordion-active:bg-default-100/5 hs-accordion-active:text-default-100">
                    <span class="text-2xl i-ph-layout-duotone"></span>
                    <span class="menu-text"> ฝ่ายยานยนต์ </span>
                    <span class="menu-arrow"></span>
                </a>

                <div id="sidenavLevel"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-1 space-y-1">
                        <li class="menu-item">
                            <a href="{{ route('car-request') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">ขออนุญาตใช้รถ</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('use-car') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">ข้อมูลการใช้รถ</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('car-report') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">ข้อมูลรถ</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @can('view user')

            <li class="px-3 py-2 text-sm font-medium text-default-400">Permission</li>

            <li class="menu-item hs-accordion">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5 hs-accordion-active:bg-default-100/5 hs-accordion-active:text-default-100">
                    <span class="text-2xl i-ph-list-duotone"></span>
                    <span class="menu-text"> Admin </span>
                    <span class="menu-arrow"></span>
                </a>

                <div id="sidenavLevel"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-1 space-y-1">
                        <li class="menu-item">
                            <a href="{{ url('users') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">User</span>
                                <span class="ms-auto inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded-md font-semibold text-xs bg-default-800 text-white">
                                    Hot
                                </span>
                            </a>

                        </li>
                        <li class="menu-item">
                            <a href="{{ url('permissions') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">Permission</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ url('roles') }}"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-1.5 text-sm font-medium text-default-100 transition-all hover:bg-default-100/5">
                                <i class="menu-dot"></i>
                                <span class="menu-text">Role</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

        </ul>
    </div>

</div>
</aside>
<!-- End Sidebar -->


