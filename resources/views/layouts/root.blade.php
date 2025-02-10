@include('layouts.root/main')

<head>
    @include('layouts.root/title-meta')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    @yield('css')
    <!-- Scripts -->
    @include('layouts.root/head-css')
</head>

<body>
    <div class="wrapper">

        {{-- @include('layouts.root/sidenav') --}}
        @livewire('layout.side-nav')

        <div class="page-content">

            {{-- @include('layouts.root/topbar') --}}
            @livewire('layout.top-bar')

            <main>
                <!-- Start Content-->
                @yield('content')
            </main>

            @include('layouts.root/footer')

        </div>

    </div>

    @include('layouts.root/footer-scripts')

    @yield('script')

   
    @vite(['resources/js/app.js'])

</body>

</html>
