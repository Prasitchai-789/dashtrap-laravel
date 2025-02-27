import ApexCharts from "apexcharts";
// column chart with datalabels

var options = {
    chart: {
        height: 400,
        type: "area",
        toolbar: {
            show: false,
        },
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) {
            return val !== null
                ? parseFloat(val).toFixed(2).toLocaleString() + ""
                : "";
        },
        offsetY: -10,
        style: {
            fontSize: "14px",
            fontFamily: " Prompt, sans-serif ",
            borderRadius: "20px", // กำหนดขอบโค้ง
            background: "#34c38f", // กำหนดสีพื้นหลัง
            padding: 7, // เพิ่มช่องว่างรอบข้อความ
            color: "#fff", // สีข้อความ
        },
    },
    stroke: {
        curve: "smooth",
        width: 3,
    },
    series: [
        {
            name: "ราคา",
            data: dataSeries,
        },
    ],
    colors: ["#34c38f"],
    grid: {
        borderColor: "#f1f1f1",
    },

    xaxis: {
        categories: categories,
        position: "bottom",
        reverse: true,
        labels: {
            offsetY: 0,
            style: {
                fontFamily: " Prompt, sans-serif ",
                fontSize: "14px", // ขนาดฟอนต์
                fontWeight: "normal", // ความหนาของฟอนต์
                color: "#333", // สีฟอนต์
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        crosshairs: {
            fill: {
                type: "gradient",
                gradient: {
                    colorFrom: "#D8E3F0",
                    colorTo: "#BED1E6",
                    stops: [0, 100],
                    opacityFrom: 0.4,
                    opacityTo: 0.5,
                },
            },
        },
        tooltip: {
            enabled: true,
            offsetY: -35,
        },
    },
    yaxis: {
        min: 5,
        max: 10,
        labels: {
            formatter: function (val) {
                return val !== null
                    ? parseFloat(val).toFixed(2).toLocaleString() + ""
                    : "";
            },
            offsetY: 0,
            style: {
                fontFamily: " Prompt, sans-serif ",
                fontSize: "14px", // ขนาดฟอนต์
                fontWeight: "normal", // ความหนาของฟอนต์
                color: "#333", // สีฟอนต์
            },
        },
    },
};

var chart = new ApexCharts(document.querySelector("#report-purchase"), options);

chart.render();





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
            data: dataSeriesGD
        }],
        colors: ['#03a9f4'],
        grid: {
            borderColor: '#f1f1f1',
            show: true,
        },
        xaxis: {
            categories: categoriesGD,
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

    var chart = new ApexCharts(document.querySelector("#graph-palm-date"), options);
    chart.render();

