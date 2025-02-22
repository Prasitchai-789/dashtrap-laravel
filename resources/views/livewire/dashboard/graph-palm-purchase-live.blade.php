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

    <p>Click the button to modify an existing PDF document with <code>pdf-lib</code></p>
    <button onclick="modifyPdf()">Modify PDF</button>
    <p class="small">(Your browser will download the resulting file)</p>

</div>


<script>
    const categories = @json($categories);
    const rawData = @json($data);
    const dataSeries = Array.isArray(rawData)
        ? rawData.map(value => {
            // ถ้าค่าที่ได้เป็น 0, null หรือ undefined จะเปลี่ยนเป็น null
            return (value === null || value === undefined || value === 0) ? null : value;
        })
        : [];
</script>
