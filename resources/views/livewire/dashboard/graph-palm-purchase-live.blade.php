<div>
    <div class="mt-2 card">
        <div class="card">
            <div class="p-6">
                <h4 class="mb-4 card-title font-prompt ">กราฟแสดงปริมาณผลปาล์มประจำปี 2025</h4>

                <div id="graph-palm" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
</div>


<script>
    const categories = @json($categories);
    const rawData = @json($data); // ค่าผลรวมปาล์ม [1500, 3200, 0, 2800, 5000, 0, 7000, ...]
    const dataSeries = Array.isArray(rawData)
        ? rawData.map(value => {
            // ถ้าค่าที่ได้เป็น 0, null หรือ undefined จะเปลี่ยนเป็น null
            return (value === null || value === undefined || value === 0) ? null : value;
        })
        : [];
</script>
