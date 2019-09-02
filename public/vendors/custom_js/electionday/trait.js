function pieTemplate(legendData, name, chartData){
    const pieData = combination(chartData);
    return {
        // Add title
        title: {
            text: name,
            x: 'center',
            textStyle: {
                fontWeight: 100,
                fontSize: 14
            }
        },
        // Add tooltip
        tooltip: {
            trigger: 'item',
            // formatter: "{a} <br/>{b}: {c} ({d}%)"
            formatter: "{a} <br/>{b}:({d}%)"
        },

        // Add legend
        legend: {
            orient: 'horizontal',
            x: 'left',
            y: 'bottom',
            data: pieData.labels
        },

        // Display toolbox
        toolbox: {
            show: true,
            orient: 'vertical',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        pie: 'Switch to pies',
                        funnel: 'Switch to funnel',
                    },
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            y: '20%',
                            width: '50%',
                            height: '70%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Add series
        series: [{
            name: name,
            type: 'pie',
            radius: '70%',
            center: ['50%', '57.5%'],
            data: pieData.seriesData,
            label: {
                normal: {
                    // formatter: "{b}: {c}\n({d}%)"
                    formatter: "({d}%)"
                }
            }
        }]
    };
}

function barTemplate(chartData, gridData = {x: 40,x2: 40,y: 35,y2: 70}, bgColor = 'rgb(252,176,59,.8)'){
    const barData = combination(chartData);
    return {

        // Setup grid
        grid: gridData,

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: []
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'verticle',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'

                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: barData.labels,
            axisLabel: {
                interval: 0,
                rotate: 30
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Party representatives',
                type: 'bar',
                data: barData.seriesData,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: bgColor,
                        label: {
                            show: true,
                            formatter: '{c}',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };
}

function combination(chartData){
    var response = [];
    var collection = [];
    var labels = [];
    const entries = Object.entries(chartData)
    for(const [key, value] of entries){
        // let valueData = (value == 0)? Math.floor(Math.random() * 100): value;
        let valueData = value;
        fdata = {name: key.charAt(0).toUpperCase()+key.slice(1), value: valueData};
        collection.push(fdata);
        labels.push(key.charAt(0).toUpperCase()+key.slice(1));
    }
    response["labels"] = labels;
    response['seriesData'] = collection;

    return response;
}