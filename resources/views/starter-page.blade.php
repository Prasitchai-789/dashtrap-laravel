@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')

<livewire:starter-page/>

@endsection


@section('script')
@vite(['resources/js/pages/dashboard.js'])
@endsection
