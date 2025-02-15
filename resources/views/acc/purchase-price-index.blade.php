@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')

<livewire:acc.purchase-price-live/>

@endsection


@section('script')

{{-- <script>
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
</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const GoodNetInput = document.getElementById("GoodNet");
        const Price2Input = document.getElementById("Price2");
        const Amnt2Input = document.getElementById("Amnt2");

        function calculateAmnt2() {
            let GoodNet = parseFloat(GoodNetInput.value.replace(/,/g, "")) || 0; // ลบคอมม่าและแปลงเป็นตัวเลข
            let Price2 = parseFloat(Price2Input.value.replace(/,/g, "")) || 0; // ลบคอมม่าและแปลงเป็นตัวเลข

            let Amnt2 = GoodNet * Price2;

            // แสดงผลลัพธ์เป็นตัวเลขที่มีคอมม่า
            Amnt2Input.value = Amnt2.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
        }

        // เมื่อมีการกรอกข้อมูลใน GoodNet หรือ Price2 จะคำนวณยอดเงินทันที
        GoodNetInput.addEventListener("input", calculateAmnt2);
        Price2Input.addEventListener("input", calculateAmnt2);
    });
</script>


@endsection
