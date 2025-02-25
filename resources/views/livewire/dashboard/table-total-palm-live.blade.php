<div>
    <div class="mt-2 card">
        <div class="card ">
            <div class="p-4">
                <h4 class="mb-4 card-title font-prompt ">กราฟแสดงปริมาณผลปาล์มประจำปี</h4>
                <div class='overflow-auto rounded-lg'>
                    <div class="rounded-lg font-anuphan">
                        <table border="1" class="flex-1 w-full p-8 overflow-scroll text-xs text-center border-collapse">
                            <thead class="py-8 bg-gray-100 rounded-t-lg ">
                                <tr class="py-8 text-xl border-b-2 border-y">
                                    <th class="p-3">เดือน</th>
                                    <th>2020</th>
                                    <th>2021</th>
                                    <th>2022</th>
                                    <th>2023</th>
                                    <th>2024</th>
                                    <th>2025</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $monthNames = [
                                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
                                7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 =>
                                'December'
                                ];
                                @endphp

                                @foreach ($monthlyGoodNet as $data)
                                <tr class="text-xl text-right border-y">
                                    <td class="p-2 pl-8 text-start">{{ $monthNames[$data->month] }}</td>
                                    <td class="pr-6">
                                        {{ $data->y2020 != 0 ? number_format($data->y2020, 0) : '-' }}
                                    </td>
                                    <td class="pr-6">
                                        {{ $data->y2021 != 0 ? number_format($data->y2021, 0) : '-' }}
                                    </td>
                                    <td class="pr-6">
                                        {{ $data->y2022 != 0 ? number_format($data->y2022, 0) : '-' }}
                                    </td>
                                    <td class="pr-6">
                                        {{ $data->y2023 != 0 ? number_format($data->y2023, 0) : '-' }}
                                    </td>
                                    <td class="pr-6">
                                        {{ $data->y2024 != 0 ? number_format($data->y2024, 0) : '-' }}
                                    </td>
                                    <td class="pr-6">
                                        {{ $data->y2025 != 0 ? number_format($data->y2025, 0) : '-' }}
                                    </td>
                                </tr>
                                @endforeach

                                <tr class="text-xl text-right border-y">
                                    <td class="p-3"><strong>รวมทั้งปี</strong></td>
                                    <td class="pr-6"><strong>{{ number_format(116597907, 0) }}</strong></td>
                                    <td class="pr-6"><strong>{{ number_format(168138430, 0) }}</strong></td>
                                    <td class="pr-6"><strong>{{ number_format($yearlyTotal->y2022, 0) }}</strong></td>
                                    <td class="pr-6"><strong>{{ number_format($yearlyTotal->y2023, 0) }}</strong></td>
                                    <td class="pr-6"><strong>{{ number_format($yearlyTotal->y2024, 0) }}</strong></td>
                                    <td class="pr-6"><strong>{{ number_format($yearlyTotal->y2025, 0) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="graph-palm" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
</div>
