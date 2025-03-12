<div>
    <h2 class="text-lg font-bold">สแกนบาร์โค้ด / QR Code</h2>
    <div id="reader" class="w-full max-w-xs mx-auto sm:max-w-xl md:max-w-lg"></div>
    <input type="text" wire:model="scannedCode" class="w-full p-2 mt-2 border rounded" readonly>

    <button wire:click="updateRecord" class="p-2 mt-2 text-white bg-blue-500 rounded">
        อัปเดตข้อมูล
    </button>

    @if (session()->has('message'))
    <p class="text-green-600">{{ session('message') }}</p>
    @elseif (session()->has('error'))
    <p class="text-red-600">{{ session('error') }}</p>
    @endif
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const html5QrCode = new Html5Qrcode("reader");

            function onScanSuccess(decodedText, decodedResult) {
                @this.scannedCode = decodedText; // ส่งค่าไป Livewire
                html5QrCode.stop();
            }

            html5QrCode.start(
                { facingMode: "environment" }, // ใช้กล้องหลัง
                { fps: 10, qrbox: { width: 250, height: 250 } },
                onScanSuccess
            ).catch(err => console.error(err));
        });
    </script>
</div>
