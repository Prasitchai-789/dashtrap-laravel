@extends('layouts.root')

@section('css')
@endsection

@section('content')

<livewire:rpo.graph-price-live/>

@endsection


@section('script')

@vite(['resources/js/pages/graph-price.js'])

@endsection
