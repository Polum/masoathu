$(function () {
    getGenderChart();
});


function getGenderChart() {
    var male_female_chart_overall = echarts.init(document.getElementById('male_female_chart_overall'));
    var male_female_bar_chart_overall = echarts.init(document.getElementById('male_female_bar_chart_overall'));
    var Q50_bar_overall = echarts.init(document.getElementById('Q50_bar_overall'));
    var Q47_chart_overall = echarts.init(document.getElementById('Q47_chart_overall'));
    var Q47_bar_overall = echarts.init(document.getElementById('Q47_bar_overall'));

    male_female_bar_chart_overall_option = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 25
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Percentages of Male and Female Registrants']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
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
            data: ['Yes', 'No']
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Percentage (%)",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: [{value: 700, name: "Yes"}, {value: 300, name: "No"}],
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            formatter: '{c}%',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };
    
    male_female_pie_options = {

        // Add title
        title: {
            text: 'Male and Female',
            x: 'center'
        },

        // Add tooltip
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },

        // Add legend
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['Yes', 'No']
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
            name: 'Male Female Registrants',
            type: 'pie',
            radius: '70%',
            center: ['50%', '57.5%'],
            data: [
                {value: 430, name: 'Yes'},
                {value: 140, name: 'No'}
            ],
            label: {
                normal: {
                    formatter: "{b}: {c}\n({d}%)"
                }
            }
        }]
    };

    Q50_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 110
        },

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
            orient: 'horizontal',
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
            data: ["DPP", "UTM", "MCP", "Indipendence"],
            axisLabel: {
                interval: 0,
                rotate: 30
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Percentage (%)",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: [{value: 3, name: "DPP"}, {value: 2, name: "UTM"}, {value: 2, name: "MCP"}, {value: 5, name: "Independence"}],
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            formatter: '{c}%',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    Q47_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 110
        },

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
            orient: 'horizontal',
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
            data: ['Yes', 'No'],
            axisLabel: {
                rotate: 30
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Percentage (%)",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: [{value: 20, name: 'Yes'}, {value: 120, name: 'No'}],
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            formatter: '{c}%',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    organisation_mobilisation_yes_no_options = {

        // Add title
        title: {
            text: 'Yes No',
            x: 'center'
        },

        // Add tooltip
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },

        // Add legend
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['Yes', 'No']
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
            name: 'Soliciting at polling station',
            type: 'pie',
            radius: '70%',
            center: ['50%', '57.5%'],
            data: [
                {value: 30, name: 'Yes'},
                {value: 20, name: 'No'}
            ],
            label: {
                normal: {
                    formatter: "{b}: {c}\n({d}%)"
                }
            }
        }]
    };

    male_female_chart_overall.setOption(male_female_pie_options);
    Q50_bar_overall.setOption(Q50_bar_overall_options);
    male_female_bar_chart_overall.setOption(male_female_bar_chart_overall_option);
    Q47_bar_overall.setOption(Q47_bar_overall_options);
    Q47_chart_overall.setOption(organisation_mobilisation_yes_no_options);
}