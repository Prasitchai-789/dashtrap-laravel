@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')

<livewire:hre.employee-live/>

@endsection


@section('script')

{{-- @vite(['resources/js/pages/dashboard.js']) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

