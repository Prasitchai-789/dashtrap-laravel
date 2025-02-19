<div>
    @include('layouts.root/page-title', ['subtitle' => 'Department', 'title' => 'Starter Page'])

    <div class="page-header">
        <div class="p-6 mb-0 bg-white rounded-lg shadow-lg page-block">
            <div class="p-4">
                <div class="p-2 mb-4 text-white bg-blue-500 rounded">
                    วันที่: {{ now()->format('d/m/Y') }}
                </div>
                <div class="p-4 mb-4 bg-green-200 rounded">
                    <h1 class="text-xl text-center">Production Dashboard {{ now()->format('d-m-Y') }}</h1>
                </div>
                <div class="p-4 mb-4 bg-gray-100 rounded">
                    <table class="w-full">
                        <tr class="bg-green-100">
                            <td class="p-2">ข้อมูล</td>
                            <td class="p-2 text-right">- ตัน</td>
                        </tr>
                        <tr class="bg-green-50">
                            <td class="p-2">ข้อมูลการผลิตเฉลี่ย</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                        <tr class="bg-green-50">
                            <td class="p-2">รวมการผลิตเฉลี่ย</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                    </table>
                </div>
                <div class="p-4 mb-4 bg-pink-100 rounded">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-pink-200">
                                <th class="p-2">พื้นที่การเก็บ</th>
                                <th class="p-2 text-right">ที่นั่ง</th>
                                <th class="p-2 text-right">เสริม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-blue-100">
                                <td class="p-2">n: A</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                            <tr class="bg-blue-100">
                                <td class="p-2">n: B</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                            <tr class="bg-blue-100">
                                <td class="p-2">n: 3</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                            <tr class="bg-blue-100">
                                <td class="p-2">แอสซัมชัญศรี</td>
                                <td class="p-2 text-right">- นาที</td>
                                <td class="p-2 text-right">- ตัน</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-4 mb-4 bg-yellow-100 rounded">
                    <div class="mb-2 text-right text-red-500">(หน่วย 3.48 ตัน/นาที)</div>
                    <table class="w-full">
                        <tr class="bg-yellow-50">
                            <td class="p-2">dU (น:น)</td>
                            <td class="p-2 text-right">- นาที</td>
                            <td class="p-2 text-right">- ตัน</td>
                        </tr>
                        <tr class="bg-yellow-50">
                            <td class="p-2">USSQ (น:น)</td>
                            <td class="p-2 text-right">- นาที</td>
                            <td class="p-2 text-right">- ตัน</td>
                        </tr>
                        <tr class="bg-yellow-50">
                            <td class="p-2">อันน (ตัน)</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                        <tr class="text-red-500 bg-yellow-50">
                            <td class="p-2">รวมการเก็บ</td>
                            <td class="p-2 text-right">195.080 ตัน</td>
                        </tr>
                    </table>
                </div>
                <div class="p-4 mb-4 bg-gray-200 rounded">
                    <table class="w-full">
                        <tr class="bg-blue-100">
                            <td class="p-2">ส:เอาฟินู CST.1</td>
                            <td class="p-2 text-right">0 cm.</td>
                            <td class="p-2 text-right">0 ตัน</td>
                        </tr>
                        <tr class="bg-blue-100">
                            <td class="p-2">ส:เอาฟินู CST.2</td>
                            <td class="p-2 text-right">3 cm.</td>
                            <td class="p-2 text-right">0.5067 ตัน</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
