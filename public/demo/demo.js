
type = ['primary', 'info', 'success', 'warning', 'danger'];

demo = {
    initPickColor: function () {
        $('.pick-class-label').click(function () {
            var new_class = $(this).attr('new-class');
            var old_class = $('#display-buttons').attr('data-class');
            var display_div = $('#display-buttons');
            if (display_div.length) {
                var display_buttons = display_div.find('.btn');
                display_buttons.removeClass(old_class);
                display_buttons.addClass(new_class);
                display_div.attr('data-class', new_class);
            }
        });
    },

    initDocChart: function () {
        chartColor = "#FFFFFF";

        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            responsive: true,
            scales: {
                yAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    display: 0,
                    gridLines: 0,
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        zeroLineColor: "transparent",
                        drawTicks: false,
                        display: false,
                        drawBorder: false
                    }
                }]
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 15,
                    bottom: 15
                }
            }
        };

        ctx = document.getElementById('lineChartExample').getContext("2d");

        gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#80b6f4');
        gradientStroke.addColorStop(1, chartColor);

        gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
        gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
        gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

        myChart = new Chart(ctx, {
            type: 'line',
            responsive: true,
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Active Users",
                    borderColor: "#f96332",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#f96332",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    fill: true,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 630]
                }]
            },
            options: gradientChartOptionsConfiguration
        });
    },

    initDashboardPageCharts: function () {

        gradientChartOptionsConfigurationWithTooltipBlue = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#2380f7"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#2380f7"
                    }
                }]
            }
        };

        gradientChartOptionsConfigurationWithTooltipPurple = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(225,78,202,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }]
            }
        };

        gradientChartOptionsConfigurationWithTooltipOrange = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 50,
                        suggestedMax: 110,
                        padding: 20,
                        fontColor: "#ff8a76"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(220,53,69,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#ff8a76"
                    }
                }]
            }
        };

        gradientChartOptionsConfigurationWithTooltipGreen = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 50,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(0,242,195,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }]
            }
        };


        gradientBarChartConfiguration = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{

                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 120,
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }],

                xAxes: [{

                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }]
            }
        };

        var chart_labels = ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'];
        var chart_cli = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var chart_fin = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var chart_con = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var chart_rec = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var chart_ven = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        if (document.getElementById("chartCli")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: "/admin/Cliente/Grafico",
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    var chart_cli = response.grafico;
                    data.datasets[0].data = chart_cli;
                    data.labels = chart_labels;
                    Clientes.update();
                }
            });

            var ctxCli = document.getElementById("chartCli").getContext('2d');

            var gradientStroke = ctxCli.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(44, 174, 236, 0.1)');
            gradientStroke.addColorStop(0.4, 'rgba(44, 174, 236, 0.0)');
            gradientStroke.addColorStop(0, 'rgba(44, 174, 236, 0)');

            var data = {
                labels: chart_labels,
                datasets: [{
                    label: "Qtde",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#2CAEEC',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#2CAEEC',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#2CAEEC',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: chart_cli,
                }]
            };

            var Clientes = new Chart(ctxCli, {
                type: 'line',
                data: data,
                options: gradientChartOptionsConfigurationWithTooltipPurple
            });
        }

        //--------------------------------------------------------------------------------------------------------------

        if (document.getElementById("chartFin")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: "/admin/Financeiro/Grafico",
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    var chart_fin = response.grafico;
                    data.datasets[0].data = chart_fin;
                    data.labels = chart_labels;
                    Financeiro.update();
                }
            });

            var ctxFin = document.getElementById("chartFin").getContext('2d');

            var gradientStroke = ctxFin.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(44, 174, 236, 0.1)');
            gradientStroke.addColorStop(0.4, 'rgba(44, 174, 236, 0.0)');
            gradientStroke.addColorStop(0, 'rgba(44, 174, 236, 0)');

            var data = {
                labels: chart_labels,
                datasets: [{
                    label: "Saldo",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#2CAEEC',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#2CAEEC',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#2CAEEC',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: chart_fin,
                }]
            };

            var Financeiro = new Chart(ctxFin, {
                type: 'line',
                data: data,
                options: gradientChartOptionsConfigurationWithTooltipPurple
            });
        }

        //--------------------------------------------------------------------------------------------------------------

        if (document.getElementById("chartCon")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: "/admin/Contas_a_pagar/Grafico",
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    var chart_con = response.grafico;
                    data.datasets[0].data = chart_con;
                    data.labels = chart_labels;
                    Contas.update();
                }
            });

            var ctxCon = document.getElementById("chartCon").getContext('2d');

            var gradientStroke = ctxCon.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(44, 174, 236, 0.1)');
            gradientStroke.addColorStop(0.4, 'rgba(44, 174, 236, 0.0)');
            gradientStroke.addColorStop(0, 'rgba(44, 174, 236, 0)');

            var data = {
                labels: chart_labels,
                datasets: [{
                    label: "Valor Total",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#2CAEEC',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#2CAEEC',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#2CAEEC',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: chart_con,
                }]
            };

            var Contas = new Chart(ctxCon, {
                type: 'line',
                data: data,
                options: gradientChartOptionsConfigurationWithTooltipPurple
            });
        }

        //--------------------------------------------------------------------------------------------------------------

        if (document.getElementById("chartRec")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: "/admin/Contas_a_receber/Grafico",
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    var chart_rec = response.grafico;
                    data.datasets[0].data = chart_rec;
                    data.labels = chart_labels;
                    Receber.update();
                }
            });

            var ctxRec = document.getElementById("chartRec").getContext('2d');

            var gradientStroke = ctxRec.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(44, 174, 236, 0.1)');
            gradientStroke.addColorStop(0.4, 'rgba(44, 174, 236, 0.0)');
            gradientStroke.addColorStop(0, 'rgba(44, 174, 236, 0)');

            var data = {
                labels: chart_labels,
                datasets: [{
                    label: "Valor Total",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#2CAEEC',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#2CAEEC',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#2CAEEC',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: chart_rec,
                }]
            };

            var Receber = new Chart(ctxRec, {
                type: 'line',
                data: data,
                options: gradientChartOptionsConfigurationWithTooltipPurple
            });
        }

        //--------------------------------------------------------------------------------------------------------------

        if (document.getElementById("chartVen")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: "/admin/Vendas/Grafico",
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    var chart_ven = response.grafico;
                    data.datasets[0].data = chart_ven;
                    data.labels = chart_labels;
                    Vendas.update();
                }
            });

            var ctxVen = document.getElementById("chartVen").getContext('2d');

            var gradientStroke = ctxVen.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(44, 174, 236, 0.1)');
            gradientStroke.addColorStop(0.4, 'rgba(44, 174, 236, 0.0)');
            gradientStroke.addColorStop(0, 'rgba(44, 174, 236, 0)');

            var data = {
                labels: chart_labels,
                datasets: [{
                    label: "Qtde",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#2CAEEC',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#2CAEEC',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#2CAEEC',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: chart_ven,
                }]
            };

            var Vendas = new Chart(ctxVen, {
                type: 'line',
                data: data,
                options: gradientChartOptionsConfigurationWithTooltipPurple
            });
        }

        //--------------------------------------------------------------------------------------------------------------

        if (document.getElementById("chartLinePurple")) {
            var ctx = document.getElementById("chartLinePurple").getContext("2d");

            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(58, 109, 252, 0.1)');
            gradientStroke.addColorStop(0.2, 'rgba(58, 109, 252, 0.0)');
            gradientStroke.addColorStop(0, 'rgba(58, 109, 252, 0)'); //purple colors

            var data = {
                labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [{
                    label: "Data",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#3A6DFC',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#3A6DFC',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#3A6DFC',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: [80, 100, 70, 80, 120, 80],
                }]
            };

            var myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: gradientChartOptionsConfigurationWithTooltipPurple
            });
        }

        if (document.getElementById("chartLineGreen")) {
            var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");

            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
            gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
            gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors

            var data = {
                labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV'],
                datasets: [{
                    label: "My First dataset",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: '#00d6b4',
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: '#00d6b4',
                    pointBorderColor: 'rgba(255,255,255,0)',
                    pointHoverBackgroundColor: '#00d6b4',
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: [90, 27, 60, 12, 80],
                }]
            };

            var myChart = new Chart(ctxGreen, {
                type: 'line',
                data: data,
                options: gradientChartOptionsConfigurationWithTooltipGreen

            });
        }





        if (document.getElementById("CountryChart")) {
            var ctx = document.getElementById("CountryChart").getContext("2d");

            var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

            gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
            gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
            gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors


            var myChart = new Chart(ctx, {
                type: 'bar',
                responsive: true,
                legend: {
                    display: false
                },
                data: {
                    labels: ['USA', 'GER', 'AUS', 'UK', 'RO', 'BR'],
                    datasets: [{
                        label: "Countries",
                        fill: true,
                        backgroundColor: gradientStroke,
                        hoverBackgroundColor: gradientStroke,
                        borderColor: '#1f8ef1',
                        borderWidth: 2,
                        borderDash: [],
                        borderDashOffset: 0.0,
                        data: [53, 20, 10, 80, 100, 45],
                    }]
                },
                options: gradientBarChartConfiguration
            });
        }
    },

    initGoogleMaps: function () {
        var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
        var mapOptions = {
            zoom: 13,
            center: myLatlng,
            scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
            styles: [{
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#1d2c4d"
                    }]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#8ec3b9"
                    }]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#1a3646"
                    }]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#4b6878"
                    }]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#64779e"
                    }]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#4b6878"
                    }]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#334e87"
                    }]
                },
                {
                    "featureType": "landscape.natural",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#023e58"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#283d6a"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#6f9ba5"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#1d2c4d"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#023e58"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#3C7680"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#304a7d"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#98a5be"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#1d2c4d"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#2c6675"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#9d2a80"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#9d2a80"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#b0d5ce"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#023e58"
                    }]
                },
                {
                    "featureType": "transit",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#98a5be"
                    }]
                },
                {
                    "featureType": "transit",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#1d2c4d"
                    }]
                },
                {
                    "featureType": "transit.line",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#283d6a"
                    }]
                },
                {
                    "featureType": "transit.station",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#3a4762"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#0e1626"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#4e6d70"
                    }]
                }
            ]
        };

        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);
    },

    showNotification: function(from, align, cor, msg, icon) {
        color = cor;

        $.notify({
          icon: icon,
          message: msg,

        }, {
          type: type[color],
          timer: 3000,
          placement: {
            from: from,
            align: align
          }
        });
      }

};
