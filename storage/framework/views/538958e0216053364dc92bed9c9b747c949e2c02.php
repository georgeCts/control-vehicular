<?php $__env->startSection('title', 'Panel'); ?>

<?php $__env->startSection('stylesheets'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/plugins/fullcalendar.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('panel'); ?>
    <h3 class="animated fadeInLeft">Panel</h3>
    <p class="animated fadeInDown">
        <span class="fa  fa-map-marker"></span> Bienvenido al control vehicular de IB-México
    </p>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- start: Calendario Eventos -->
    <div class="col-md-12 padding-0">
        <div class="panel box-v4">
            <div class="panel-heading bg-white border-none">
                <h4><span class="icon-notebook icons"></span> CALENDARIO DE EVENTOS</h4>
            </div>
            <div class="panel-body padding-0">
                <div class="calendar"></div>
            </div>
        </div> 
    </div>
    <!-- end: Calendario Eventos -->

    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">INCIDENTES ABIERTOS</h3>
                        </div>
                        <div class="panel-body"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">PR&Oacute;XIMOS EVENTOS</h3>
                        </div>
                        <div class="panel-body"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                                <h4>GASTO COMBUSTIBLE</h4>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-bottom:50px;">
                            <div id="canvas-holder1">
                                <canvas class="bar-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                                <h4>GASTO MANTENIMIENTO</h4>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-bottom:50px;">
                            <div id="canvas-holder1">
                                <canvas class="bar-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/chart.min.js')); ?>"></script>


    <!-- custom -->
    <script type="text/javascript">
        (function(jQuery){

            // start: Chart =============
            Chart.defaults.global.pointHitDetectionRadius = 1;
            Chart.defaults.global.customTooltips = function(tooltip) {

                var tooltipEl = $('#chartjs-tooltip');

                if (!tooltip) {
                    tooltipEl.css({
                        opacity: 0
                    });
                    return;
                }

                tooltipEl.removeClass('above below');
                tooltipEl.addClass(tooltip.yAlign);

                var innerHtml = '';
                if (undefined !== tooltip.labels && tooltip.labels.length) {
                    for (var i = tooltip.labels.length - 1; i >= 0; i--) {
                        innerHtml += [
                            '<div class="chartjs-tooltip-section">',
                            '   <span class="chartjs-tooltip-key" style="background-color:' + tooltip.legendColors[i].fill + '"></span>',
                            '   <span class="chartjs-tooltip-value">' + tooltip.labels[i] + '</span>',
                            '</div>'
                        ].join('');
                    }
                    tooltipEl.html(innerHtml);
                }

                tooltipEl.css({
                    opacity: 1,
                    left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
                    top: tooltip.chart.canvas.offsetTop + tooltip.y + 'px',
                    fontFamily: tooltip.fontFamily,
                    fontSize: tooltip.fontSize,
                    fontStyle: tooltip.fontStyle
                });
            };


            var randomScalingFactor = function() {
                return Math.round(Math.random() * 100);
            };

            var lineChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    fillColor: "rgba(21,186,103,0.4)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(66,69,67,0.3)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [18,9,5,7,4.5,4,5,4.5,6,5.6,7.5]
                }, {
                    label: "My Second dataset",
                    fillColor: "rgba(21,113,186,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [4,7,5,7,4.5,4,5,4.5,6,5.6,7.5]
                }]
            };

            var doughnutData = [
                {
                    value: 300,
                    color:"#129352",
                    highlight: "#15BA67",
                    label: "Alfa"
                },
                {
                    value: 50,
                    color: "#1AD576",
                    highlight: "#15BA67",
                    label: "Beta"
                },
                {
                    value: 100,
                    color: "#FDB45C",
                    highlight: "#15BA67",
                    label: "Gamma"
                },
                {
                    value: 40,
                    color: "#0F5E36",
                    highlight: "#15BA67",
                    label: "Peta"
                },
                {
                    value: 120,
                    color: "#15A65D",
                    highlight: "#15BA67",
                    label: "X"
                }

            ];


            var doughnutData2 = [
                {
                    value: 100,
                    color:"#129352",
                    highlight: "#15BA67",
                    label: "Alfa"
                },
                {
                    value: 250,
                    color: "#FF6656",
                    highlight: "#FF6656",
                    label: "Beta"
                },
                {
                    value: 100,
                    color: "#FDB45C",
                    highlight: "#15BA67",
                    label: "Gamma"
                },
                {
                    value: 40,
                    color: "#FD786A",
                    highlight: "#15BA67",
                    label: "Peta"
                },
                {
                    value: 120,
                    color: "#15A65D",
                    highlight: "#15BA67",
                    label: "X"
                }

            ];

            var barChartData = {
                labels: ["April", "May", "June", "July", "August"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(21,186,103,0.4)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(21,186,103,0.2)",
                        highlightStroke: "rgba(21,186,103,0.2)",
                        data: [80, 81, 56, 55, 40]
                    }
                ]
            };

            window.onload = function(){
                /*var ctx = $(".doughnut-chart")[0].getContext("2d");
                window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
                    responsive : true,
                    showTooltips: true
                });

                var ctx2 = $(".line-chart")[0].getContext("2d");
                window.myLine = new Chart(ctx2).Line(lineChartData, {
                     responsive: true,
                        showTooltips: true,
                        multiTooltipTemplate: "<%= value %>",
                     maintainAspectRatio: false
                });*/

                var ctx3 = $(".bar-chart")[0].getContext("2d");
                window.myLine = new Chart(ctx3).Bar(barChartData, {
                     responsive: true,
                        showTooltips: true
                });

                /*var ctx4 = $(".doughnut-chart2")[0].getContext("2d");
                window.myDoughnut2 = new Chart(ctx4).Doughnut(doughnutData2, {
                    responsive : true,
                    showTooltips: true
                });*/

            };        
            //  end:  Chart =============

            // start: Calendar =========
            $('.dashboard .calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                businessHours: true, // display business hours
                editable: false,
                events: [
                    {
                        title: 'Business Lunch',
                        start: '2018-08-03T13:00:00',
                        constraint: 'businessHours'
                    },
                    {
                        title: 'Meeting',
                        start: '2018-08-13T11:00:00',
                        constraint: 'availableForMeeting', // defined below
                        color: '#20C572'
                    },
                    {
                        title: 'Conference',
                        start: '2018-08-22T12:00:00',
                        end: '2018-08-24T11:00:00'
                    },
                    {
                        title: 'Party',
                        start: '2018-08-29T20:00:00'
                    },

                    // areas where "Meeting" must be dropped
                    {
                        id: 'availableForMeeting',
                        start: '2018-08-11T10:00:00',
                        end: '2018-08-11T16:00:00',
                        rendering: 'background'
                    },
                    {
                        id: 'availableForMeeting',
                        start: '2018-08-13T10:00:00',
                        end: '2018-08-13T16:00:00',
                        rendering: 'background'
                    },

                    // red areas where no events can be dropped
                    {
                        start: '2018-08-24',
                        end: '2018-08-28',
                        overlap: false,
                        rendering: 'background',
                        color: '#FF6656'
                    },
                    {
                        start: '2018-08-06',
                        end: '2018-08-08',
                        overlap: true,
                        rendering: 'background',
                        color: '#FF6656'
                    }
                ]
            });
            // end : Calendar==========
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('components.LeftSideMenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.LeftSideMenuMobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Stylesheets', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('components.Favicon', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make('components.Main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>