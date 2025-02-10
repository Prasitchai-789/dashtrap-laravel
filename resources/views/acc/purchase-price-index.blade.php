@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')

<livewire:acc.purchase-price-live/>

@endsection


@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const goodNetInput = document.getElementById("GoodNet");
        const price2Input = document.getElementById("Price2");
        const amnt2Input = document.getElementById("Amnt2");
    
        function calculateAmnt2() {
            let goodNet = parseFloat(goodNetInput.value) || 0;
            let price2 = parseFloat(price2Input.value) || 0;
            amnt2Input.value = (goodNet * price2).toFixed(0); // แสดงผลแบบทศนิยม 2 ตำแหน่ง
        }
    
        price2Input.addEventListener("input", calculateAmnt2);
    });
</script>

@endsection
