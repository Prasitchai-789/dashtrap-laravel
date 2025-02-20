@extends('layouts.root')

@section('css')
@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('5e2e0382066d67e433a6', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('notify-channel');
channel.bind('form-submit', function(data) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: data.title,
        text: data.text,
        showConfirmButton: false,
        timer: 1500,
        customClass: {
            title: "font-anuphan", // เพิ่มคลาสสำหรับ title
            htmlContainer: "font-anuphan text-md",
        },
    });

    // รอให้ Swal แสดงผลก่อนรีโหลดหน้า
    setTimeout(() => {
        location.reload();
    }, 1000);
});
</script>
@endsection

@section('content')

<livewire:rpo.report-palm-purchase-live />

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


@vite(['resources/js/pages/charts-apex.js'])


@endsection
