const setChart = (seriesData, categories, title, yAxisTitle, id) => {
    var options = {
        chart: {
            type: 'line',
            height: 300,
            background: '#1B1B1B',
            toolbar: {
                show: false
            }
        },
        series: [{
            name: yAxisTitle,
            data: seriesData
        }],
        xaxis: {
            categories,
            labels: {
                style: {
                    colors: '#fff',
                    fontSize: '12px'
                },
                show: true
            },
            axisBorder: {
                show: true
            },
            axisTicks: {
                show: true
            }
        },
        yaxis: {
            title: {
                text: yAxisTitle,
                style: {
                    color: '#fff',
                    fontSize: '12px'
                }
            },
            labels: {
                style: {
                    colors: '#fff',
                    fontSize: '12px'
                },
                show: true
            },
            axisBorder: {
                show: true
            },
            axisTicks: {
                show: true
            }
        },
        title: {
            text: title,
            align: 'right',
            style: {
                color: '#fff',
                fontWeight: 600,
                fontFamily: "Poppins"
            }
        },
        stroke: {
            curve: 'smooth',
            width: 4,
            colors: ['#BF00FF'],
            lineCap: 'round'
        },
        grid: {
            borderColor: '#444',
            show: true
        },
        tooltip: {
            theme: 'dark'
        },
        plotOptions: {
            line: {
                dropShadow: {
                    enabled: true,
                    color: '#BF00FF',
                    top: 0,
                    left: 0,
                    blur: 5,
                    opacity: 0.6
                }
            }
        }
    };
    
    var chart = new ApexCharts(document.getElementById(id), options);
    chart.render();
}
