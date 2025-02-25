<div>
    @include('layouts.root/page-title', ['subtitle' => 'ฝ่ายจัดซื้อปาล์ม', 'title' => 'กราฟราคา'])

    <div class="mt-2 card">
        <div class="card">
            <div class="p-6">
                <h4 class="mb-4 card-title font-prompt ">กราฟแสดงราคาเฉลี่ย</h4>

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

