@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection

@section('content')

<livewire:rpo.sales-product-live/>

@endsection


@section('script')
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const IBWeiInput = document.getElementById("IBWei");
        const OBWeiInput = document.getElementById("OBWei");
        const NetWeiInput = document.getElementById("NetWei");

        function calculateNetWeight() {
            let IBWei = parseFloat(IBWeiInput.value) || 0;
            let OBWei = parseFloat(OBWeiInput.value) || 0;
            let NetWei = OBWei - IBWei;

            NetWeiInput.value = NetWei.toFixed(0); // แสดงผลลัพธ์เป็นทศนิยม 2 ตำแหน่ง
        }

        IBWeiInput.addEventListener("input", calculateNetWeight);
        OBWeiInput.addEventListener("input", calculateNetWeight);
    });
</script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const IBWeiInput = document.getElementById("IBWei");
        const OBWeiInput = document.getElementById("OBWei");
        const NetWeiInput = document.getElementById("NetWei");

        // ฟังก์ชันแสดงคอมม่าที่ตัวเลข
        function formatNumberWithCommas(value) {
            return value.toLocaleString("en-US"); // แสดงคอมม่า
        }

        // ฟังก์ชันแปลงค่าจากสตริงเป็นตัวเลข โดยลบคอมม่าออก
        function parseNumber(value) {
            return parseFloat(value.replace(/,/g, "")) || 0; // ลบคอมม่าออกก่อนแปลงเป็นตัวเลข
        }

        // ฟังก์ชันคำนวณน้ำหนักสุทธิ
        function calculateGoodNet() {
            let IBWei = parseNumber(IBWeiInput.value);
            let OBWei = parseNumber(OBWeiInput.value);
            let NetWei = OBWei - IBWei;

            // แสดงผลลัพธ์น้ำหนักสุทธิที่มีคอมม่า
            NetWeiInput.value = formatNumberWithCommas(NetWei);
        }

        // ฟังก์ชันตรวจสอบเมื่อมีการกรอกข้อมูลใหม่
        function handleInput(event) {
            let value = event.target.value.replace(/,/g, ""); // ลบคอมม่าออก
            if (!isNaN(value) && value !== "") {
                event.target.value = formatNumberWithCommas(Number(value)); // แสดงคอมม่า
            } else {
                event.target.value = ""; // ล้างค่าออกหากไม่ใช่ตัวเลข
            }
            calculateGoodNet(); // คำนวณน้ำหนักสุทธิทุกครั้งที่เปลี่ยนค่า
        }

        IBWeiInput.addEventListener("input", handleInput);
        OBWeiInput.addEventListener("input", handleInput);
    });
</script>

@endsection
