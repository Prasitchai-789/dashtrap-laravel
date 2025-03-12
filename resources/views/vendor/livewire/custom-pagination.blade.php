@if ($paginator->hasPages())

<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4 ml-4 item-center">
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-start">
        <div class="hidden sm:flex me-4">
            <p class="text-sm leading-5 text-gray-700 dark:text-gray-400">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>
    {{-- ปุ่มก่อนหน้า --}}
    @if ($paginator->onFirstPage())
    <span
        class="me-2 inline-flex items-center justify-center size-[32px] text-sm font-semibold leading-none rounded-full bg-gray-100 text-primary-800"><i
            class="fa-solid fa-less-than"></i></span>
    @else
    <button wire:click="previousPage"
        class="me-2 inline-flex items-center justify-center size-[32px] text-sm font-semibold leading-none rounded-full bg-primary-500 text-white"><i
            class="fa-solid fa-less-than"></i></button>
    @endif

    {{-- หน้าปัจจุบัน --}}
    @foreach ($elements as $element)
    @if (is_string($element))
    <span class="px-3 py-2 text-gray-500">{{ $element }}</span>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <span
        class="me-2 inline-flex items-center justify-center size-[32px] text-sm font-semibold leading-none rounded-full bg-primary-500 text-white">{{
        $page }}</span>
    @else
    <button wire:click="gotoPage({{ $page }})"
        class="me-2 inline-flex items-center justify-center size-[32px] text-sm font-semibold leading-none rounded-full bg-gray-100 text-primary-800">{{
        $page }}</button>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- ปุ่มถัดไป --}}
    @if ($paginator->hasMorePages())
    <button wire:click="nextPage"
        class="me-2 inline-flex items-center justify-center size-[32px] text-sm font-semibold leading-none rounded-full bg-primary-500 text-white"><i
            class="fa-solid fa-greater-than"></i></button>
    @else
    <span
        class="me-2 inline-flex items-center justify-center size-[32px] text-sm font-semibold leading-none rounded-full bg-gray-100 text-primary-800"><i
            class="fa-solid fa-greater-than"></i></span>
    @endif
</div>
</nav>
@endif
