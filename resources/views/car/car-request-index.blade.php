@extends('layouts.root')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
<audio id="successSound">
    <source src="https://www.fesliyanstudios.com/play-mp3/4386" type="audio/mpeg">
</audio>

@vite(['node_modules/jsvectormap/dist/css/jsvectormap.min.css'])
@endsection

@section('content')

<livewire:car.car-request-live />

@endsection


@section('script')
{{-- <script>
    window.addEventListener("confirmApprove", event => {
    const carRequestId = event.detail;
    let data = event.detail;

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: "bg-danger me-2 p-3 rounded text-white font-anuphan",
            confirmButton: "bg-success me-2 p-3 rounded text-white font-anuphan",
            title: "font-prompt text-2xl",
            htmlContainer: "font-prompt text-lg",
        },
        buttonsStyling: false,
    });

    swalWithBootstrapButtons
        .fire({
            // title: 'คุณต้องการอนุมัติคำขอนี้หรือไม่?',
            text: "คุณต้องการอนุมัติคำขอนี้หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่, อนุมัติ!',
            cancelButtonText: 'ไม่อนุมัติ'
        })
        .then((result) => {
            if (result.isConfirmed) {
                // เมื่ออนุมัติ
                Livewire.dispatch('approveCarRequest', carRequestId); // ส่งค่า carRequestId ไปยัง Livewire
                Swal.fire({
                title: 'อนุมัติแล้ว!',
                text: 'คำขอได้ถูกอนุมัติเรียบร้อย.',
                icon: 'success',
                showConfirmButton: false,
                timer: 2500,
                customClass: {
                    confirmButton: 'blue-button',
                    title: "font-prompt text-2xl",
                    htmlContainer: "font-prompt text-lg",
                },
                buttonsStyling: false // ปิดการใช้งาน styles เริ่มต้นของ SweetAlert
            });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // เมื่อไม่อนุมัติ
                Livewire.dispatch('rejectCarRequest', carRequestId); // ส่งค่า carRequestId ไปยัง Livewire
                Swal.fire({
                title: 'ไม่อนุมัติ!',
                text: 'คำขอได้ถูกปฏิเสธเรียบร้อย.',
                icon: 'error',
                // confirmButtonText: 'OK',
                showConfirmButton: false,
                timer: 2500,
                customClass: {
                    confirmButton: 'blue-button' ,
                    title: "font-prompt text-2xl",
            htmlContainer: "font-prompt text-lg",
                },
                buttonsStyling: false // ปิดการใช้งาน styles เริ่มต้นของ SweetAlert
            });
            }
        });
});
</script> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
