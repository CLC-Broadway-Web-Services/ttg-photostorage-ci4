"use strict";

!function (NioApp, $) {
    "use strict";

    var crn_statistics = JSON.parse($('#crn_statistics').html());
    var asset_statistics = JSON.parse($('#asset_statistics').html());
    var shipment_statistics = JSON.parse($('#shipment_statistics').html());

    var straightLineChart = {
        labels: crn_statistics['dates'],
        dataUnit: 'CRN',
        lineTension: 0,
        datasets: [{
            label: "Total CRN's",
            color: "#9d72ff",
            background: NioApp.hexRGB('#9d72ff', .3),
            data: crn_statistics['counts']
        }]
    };
    var straightLineChart2 = {
        labels: asset_statistics['dates'],
        dataUnit: 'CRN',
        lineTension: 0,
        datasets: [{
            label: "Total CRN's",
            color: "#9d72ff",
            background: NioApp.hexRGB('#9d72ff', .3),
            data: asset_statistics['counts']
        }]
    };
    var straightLineChart3 = {
        labels: shipment_statistics['dates'],
        dataUnit: 'CRN',
        lineTension: 0,
        datasets: [{
            label: "Total CRN's",
            color: "#9d72ff",
            background: NioApp.hexRGB('#9d72ff', .3),
            data: shipment_statistics['counts']
        }]
    };

    function lineChart(selector, set_data) {
        var $selector = selector ? $(selector) : $('.line-chart');
        $selector.each(function () {
            var $self = $(this),
                _self_id = $self.attr('id'),
                _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;

            var selectCanvas = document.getElementById(_self_id).getContext("2d");
            var chart_data = [];

            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: _get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: _get_data.datasets[i].color,
                    pointBackgroundColor: '#fff',
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 4,
                    data: _get_data.datasets[i].data
                });
            }

            var chart = new Chart(selectCanvas, {
                type: 'line',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: _get_data.legend ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 12,
                            padding: 20,
                            fontColor: '#6783b8'
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function title(tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function label(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 13,
                        titleFontColor: '#6783b8',
                        titleMarginBottom: 6,
                        bodyFontColor: '#9eaecf',
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            position: NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: false,
                                fontSize: 12,
                                fontColor: '#9eaecf',
                                padding: 10
                            },
                            gridLines: {
                                color: NioApp.hexRGB("#526484", .2),
                                tickMarkLength: 0,
                                zeroLineColor: NioApp.hexRGB("#526484", .2)
                            }
                        }],
                        xAxes: [{
                            display: true,
                            ticks: {
                                fontSize: 12,
                                fontColor: '#9eaecf',
                                source: 'auto',
                                padding: 5,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 10,
                                zeroLineColor: NioApp.hexRGB("#526484", .2),
                                offsetGridLines: true
                            }
                        }]
                    }
                }
            });
        });
    } // init line chart


    lineChart(); //////// for developer - pieChart //////// 
    // Avilable options to pass from outside 
    // labels: array,
    // legend: false - boolean,
    // dataUnit: string, (Used in tooltip or other section for display) 
    // datasets: [{label : string, color: string (color code with # or other format), data: array}]

}(NioApp, jQuery);