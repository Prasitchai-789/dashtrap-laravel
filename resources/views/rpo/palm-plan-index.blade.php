@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('5e2e0382066d67e433a6', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('notify-channel');
    channel.bind('form-submit', function(data) {

      location.reload();
    });
  </script>
@endsection

@section('content')

<livewire:rpo.palm-plan-live />

@endsection


@section('script')

{{-- @vite(['resources/js/pages/dashboard.js']) --}}


@endsection
