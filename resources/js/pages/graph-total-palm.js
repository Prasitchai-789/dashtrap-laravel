import ApexCharts from "apexcharts";
// column chart with datalabels

document.addEventListener('updateChart', function (event) {


    // ตรวจสอบค่าที่ได้จาก event
    console.log('Categories:', categories);
    console.log('Data Series:', dataSeries);

    var options = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                    position: 'top', // กำหนดตำแหน่ง dataLabels ให้อยู่ภายในแท่ง
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val !== null ? Math.floor(val / 1000).toLocaleString() + "" : "";
            },
            offsetY: -30,
            style: {
                fontSize: '16px',
                colors: ["#304758"],
                fontWeight: 'bold',
                transform: 'rotate(-90deg)',
                transformOrigin: 'left center',
                textAnchor: 'middle'
            }
        },
        series: [{
            name: 'ปริมาณผลปาล์ม',
            data: dataSeries
        }],
        colors: ['#03a9f4'],
        grid: {
            borderColor: '#f1f1f1',
            show: true,
        },
        xaxis: {
            categories: categories,
            position: 'bottom',
            labels: {
                offsetY: 0,
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
                offsetY: -35,
            }
        },
        fill: {
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [50, 0, 100, 100]
            },
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val !== null ? val.toLocaleString() + " kg" : "";
                }
            }
        },
        title: {
            text: '',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444',
                fontWeight: '500',
                fontFamily: " Prompt, sans-serif ",
            }
        },
    }

    var chart = new ApexCharts(document.querySelector("#graph-total-palm"), options);
    chart.render();
});

