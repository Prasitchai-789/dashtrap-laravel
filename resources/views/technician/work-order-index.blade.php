@extends('layouts.root')

@section('css')
<script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>
<script src="https://unpkg.com/pdf-lib@1.4.0"></script>
<script src="https://unpkg.com/downloadjs@1.4.7"></script>
@endsection

@section('content')

<livewire:technician.work-order-live />

<div id="loading" class="font-prompt"

    style="display: none ; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0, 0, 0, 0.7); color: white; padding: 15px 20px; border-radius: 15px; font-size: 16px; font-weight: bold;">
    กำลังสร้างเอกสาร
    <button type="button" class="inline-flex items-center justify-center gap-3 px-5 py-2 text-base font-semibold tracking-wide text-center align-middle duration-500 rounded-full cursor-default border-primary/10 text-primary hover:text-white">
        <div class="animate-spin w-5 h-5 border-[3px] border-current border-t-transparent rounded-full" role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
        </div>
        Loading...
    </button> <!-- button-end -->
</div>


@endsection


@section('script')


<script>
    window.addEventListener('modifyPdf', function(event) {
        modifyPdf(event);
    });

    const { degrees, PDFDocument, rgb, StandardFonts } = PDFLib;

    async function modifyPdf(event) {
        const loadingElement = document.getElementById("loading");
        loadingElement.style.display = "block"; // แสดง Loading

        try {
            // ดึง PDF ต้นฉบับ
            const pdfUrl = '/pdfs/FM-ITE-68-0004_Network.pdf';
            const existingPdfBytes = await fetch(pdfUrl).then(res => res.arrayBuffer());

            // โหลด PDF
            const pdfDoc = await PDFDocument.load(existingPdfBytes);
            pdfDoc.registerFontkit(fontkit);

            // โหลดฟอนต์ภาษาไทย
            const thaiFontBytes = await fetch('https://script-app.github.io/font/THSarabunNew.ttf').then(res => res.arrayBuffer());
            const thaiFont = await pdfDoc.embedFont(thaiFontBytes);

            // ดึงหน้าแรก
            const firstPage = pdfDoc.getPages()[0];
            const { width, height } = firstPage.getSize();

            // 🔹 ฟังก์ชันช่วยใส่ข้อความลง PDF
            function drawText(text, x, y, size = 14) {
                if (text) {
                    firstPage.drawText(text, { x, y, size, font: thaiFont, color: rgb(0.1, 0.1, 0.95) });
                }
            }

            // 🔹 ใส่ข้อมูลในเอกสาร
            drawText(event.detail.Number, width / 2 + 115, height / 2 + 302, 16);
            drawText(event.detail.NameOfInformant, 77, 700);
            drawText(event.detail.NameOfInformant, 340, 560);
            drawText(event.detail.Date, 370, 540);
            drawText('', 258, 700); // แผนก
            drawText('', 358, 700); // ฝ่าย
            drawText(event.detail.Location, 155, 681);
            drawText(event.detail.MachineName, 394, 681);
            drawText(event.detail.Detail, 145, 644);
            drawText(event.detail.RepairDate, 115, 479);
            drawText(event.detail.finishDate, 285, 479);
            drawText(event.detail.RepairReport, 125, 423);
            drawText(event.detail.Technician, 305, 132);
            drawText(event.detail.finishDate, 310, 112);

            // 🔹 สร้างไฟล์ PDF ใหม่
            const pdfBytes = await pdfDoc.save();

            // 🔹 ดาวน์โหลด PDF
            download(pdfBytes, "ใบแจ้งซ่อม FM-ITE-68-0004.pdf", "application/pdf");

        } catch (error) {
            console.error("เกิดข้อผิดพลาด:", error);
            alert("เกิดข้อผิดพลาดในการสร้างไฟล์ PDF");
        } finally {
            loadingElement.style.display = "none"; // ซ่อน Loading
        }
    }
</script>


@endsection
