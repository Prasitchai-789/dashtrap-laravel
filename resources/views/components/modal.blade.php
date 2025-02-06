@props(['id', 'maxWidth', 'title', 'zIndex', 'closeModal'])

@php
$id = $id ?? md5($attributes->wire('model'));
$maxWidth = [
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
'4xl' => 'sm:max-w-4xl',
'6xl' => 'sm:max-w-6xl',
][$maxWidth ?? '2xl'];

// z-index
$zIndex = $zIndex ?? 999;
@endphp

<div x-data="{ show: @entangle($attributes->wire('model')) }"
    x-init="$watch('show', value => { if (value) { setTimeout(() => show = true, 30); } })" x-show="show" x-cloak
    x-on:close.stop="show = false" x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0">

    <!-- Background Overlay -->
    <div class="fixed inset-0 transition-opacity" x-show="show" x-on:click="show = false"
        x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-75"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-700 opacity-50"></div>
    </div>

    <!-- Modal Content -->
    <div class="w-full {{ $maxWidth }} mb-6 transition-transform transform bg-white rounded-lg shadow-xl md:mx-auto"
        :class="{'w-full': show, 'md:w-auto': !show}" x-show="show" x-trap.inert.noscroll="show"
        x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-75"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95">
        <!-- Content Here -->
        <div class="relative w-full {{ $maxWidth }} max-h-full">
            <!-- Modal content -->
            <div class="w-auto {{ $maxWidth }} overflow-hidden bg-white rounded-lg shadow-lg">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-3 border-b rounded-t bg-primary md:p-4">
                    <h3 class="text-xl font-semibold text-white font-prompt">
                        {{ $title }}
                    </h3>
                    <button type="button" x-on:click="show = false" wire:click="closeModal"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-red-600 bg-transparent rounded-lg hover:bg-red-500 hover:text-white ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="md:p-2 sm:w-full">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
