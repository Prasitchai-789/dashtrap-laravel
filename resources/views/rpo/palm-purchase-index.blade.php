@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


@endsection

@section('content')

<livewire:rpo.palm-purchase-live />

@endsection


@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const GoodOBInput = document.getElementById("GoodOB");
        const GoodIBInput = document.getElementById("GoodIB");
        const GoodNetInput = document.getElementById("GoodNet");

        function formatNumberWithCommas(value) {
            return value.toLocaleString("en-US"); // แสดงคอมม่า
        }

        function parseNumber(value) {
            return parseFloat(value.replace(/,/g, "")) || 0; // ลบคอมม่าออกก่อนแปลงเป็นตัวเลข
        }

        function calculateGoodNet() {
            let GoodOB = parseNumber(GoodOBInput.value);
            let GoodIB = parseNumber(GoodIBInput.value);
            let GoodNet = GoodIB - GoodOB;

            GoodNetInput.value = formatNumberWithCommas(GoodNet); // แสดงคอมม่า
        }

        function handleInput(event) {
            let value = event.target.value.replace(/,/g, ""); // ลบคอมม่าออก
            if (!isNaN(value) && value !== "") {
                event.target.value = formatNumberWithCommas(Number(value)); // แสดงคอมม่า
            } else {
                event.target.value = ""; // ล้างค่าออกหากไม่ใช่ตัวเลข
            }
            calculateGoodNet(); // อัปเดตคำนวณ GoodNet ทุกครั้งที่เปลี่ยนค่า
        }

        GoodOBInput.addEventListener("input", handleInput);
        GoodIBInput.addEventListener("input", handleInput);
    });
</script>

@endsection
