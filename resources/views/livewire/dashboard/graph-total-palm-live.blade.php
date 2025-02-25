<div>

    <select wire:change="setMonth" wire:model="selectedMonth" class="w-1/4 form-select">
        @for ($m = 1; $m <= 12; $m++)
            <option value="{{ $m }}">{{ date("F", mktime(0, 0, 0, $m, 1)) }}</option>
        @endfor
    </select>

    <div id="graph-total-palm" class="mt-6 apex-charts" dir="ltr"></div>

</div>

<script>
    const categories = @json($categories);
    const rawData = @json($dataSeries);
    const dataSeries = Array.isArray(rawData)
        ? rawData.map(value => {
            // ถ้าค่าที่ได้เป็น 0, null หรือ undefined จะเปลี่ยนเป็น null
            return (value === null || value === undefined || value === 0) ? null : value;
        })
        : [];
</script>
