@extends('layouts.root')

@section('css')
@endsection

@section('content')

<livewire:dashboard.graph-total-palm-live/>

@endsection


@section('script')

@vite(['resources/js/pages/graph-total-palm.js'])

@endsection
