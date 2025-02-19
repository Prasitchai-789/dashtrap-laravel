@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@vite(['node_modules/glightbox/dist/css/glightbox.min.css'])
@endsection

@section('content')

<livewire:test-live/>

@endsection


@section('script')
@vite(['resources/js/pages/dashboard.js'])
@vite(['resources/js/pages/gallery.js'])
@endsection
