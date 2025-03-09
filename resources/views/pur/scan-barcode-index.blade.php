@extends('layouts.root')

@section('css')
{{-- @vite(['resources/js/pages/scan-barcode.js']) --}}
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>


@endsection

@section('content')

<livewire:pur.scan-barcode-live/>

@endsection


@section('script')



@endsection
