{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')
@include('layouts.root/page-title', ['subtitle' => 'Department', 'title' => 'Profile Information'])
<div class="page-header">
    <div class="p-6 mb-0 bg-white rounded-lg shadow-lg page-block">
            <div class="max-w-xl mb-6">
                <livewire:profile.update-profile-information-form />
            </div>
            <hr class="my-6 border-gray-300 border-dashed border-t-1">
            <div class="max-w-xl mb-6">
                <livewire:profile.update-password-form />
            </div>
            <hr class="my-6 border-gray-300 border-dashed border-t-1">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
    </div>
</div>

@endsection


@section('script')
@vite(['resources/js/pages/dashboard.js'])
@endsection
