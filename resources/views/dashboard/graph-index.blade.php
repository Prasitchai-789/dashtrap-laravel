@extends('layouts.root')

@section('css')
@endsection

@section('content')

<livewire:dashboard.graph-palm-purchase-live/>

@endsection


@section('script')

@vite(['resources/js/pages/graph-palm.js'])

@endsection
