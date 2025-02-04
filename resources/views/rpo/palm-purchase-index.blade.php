@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')

<livewire:rpo.palm-purchase-live />

@endsection


@section('script')

{{-- @vite(['resources/js/pages/dashboard.js']) --}}


@endsection
