@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')

<livewire:hre.use-car-live/>

@endsection


@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

