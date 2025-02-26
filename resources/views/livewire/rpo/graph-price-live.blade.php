<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'กราฟราคา'])

    <div class="mt-2 card">
        <div class="card">
            <div class="p-6">
                <h4 class="flex justify-center mb-4 text-2xl text-blue-700 card-title font-prompt">ราคารับซื้อผลปาล์ม วันที่  {{
                    \Carbon\Carbon::parse($averagePrices->created_at)->locale('th')->translatedFormat('d F Y')
                    }}</h4>

                <div id="graph-price" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
</div>
<script>
    const categories = @json($categories);
    const dataSeries = @json($data);
</script>

