<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'กราฟราคา'])

    <div class="mt-2 card">
        <div class="card">
            <div class="p-6">
                <h4 class="flex justify-center mb-4 text-2xl card-title font-prompt">ราคารับซื้อผลปาล์ม วันที่ </h4>

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

