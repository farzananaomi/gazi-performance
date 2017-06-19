@extends('layouts.base')
@section('content-header')
    <h1>
        Sales Report
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Reporting</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6 col-xs-s12">
            <div class="row">
                <div class="col-xs-12">
                    <span class="stat-title">Report of Month/Year</span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button class="picker-control" data-toggle="modal" data-target="#report-picker">
                        <span class="control-label">  Month</span>
                        <span class="control-value"><i class="fa fa-calendar"></i> June</span>
                    </button>
                </div>
                <div class="col-xs-6">
                    <button class="picker-control" data-toggle="modal" data-target="#report-picker">
                        <span class="control-label">  Year</span>
                        <span class="control-value"><i class="fa fa-calendar-check-o"></i> 2016</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-s12">
            <div class="row">
                <div class="col-xs-12">
                    <span class="stat-title">Overall Stats</span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="stat-box">
                        <span class="stat-label">Total Sales (Tk.)</span>
                        <span class="stat-value"><i class="fa fa-money"></i> 2.43 lakh</span>
                    </div></div>
                <div class="col-xs-6">
                    <div class="stat-box">
                        <span class="stat-label">Total Sales (Amount)</span>
                        <span class="stat-value"><i class="material-icons">shopping_basket</i> 258000</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="row" style="margin-top: 35px;">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales Contribution (Tk.)</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12"></div>
    </div>
    
    <div class="modal fade" id="report-picker" tabindex="-1" role="dialog" aria-labelledby="report-month-year-picker">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="report-month-year-picker">Select Report Month/Year</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%" data-date="{{ \Carbon\Carbon::now()->format('d-m-Y') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-lg" style="background: #00a65a;">Show</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @parent
    <style>
        #calendar td span.active, #calendar td span.focused {
            color: #ffffff;
            background: #00a65a;
            font-size: 24px;
        }
        #calendar td span {
            font-size: 20px;
        }
        #calendar .datepicker,  #calendar .datepicker table {
            width: 100% !important;
        }
        .datepicker-switch {
            font-size: 22px;
        }
        .datepicker .datepicker-switch:hover, .datepicker .prev:hover, .datepicker .next:hover, .datepicker tfoot tr th:hover {
            background: #eeeeee !important;
        }
    </style>
    <style>
        .stat-title {
            font-size: 18px;
            text-align: center;
        }
        .stat-box {
            display: block;
            width: 100%;
            height: 100%;
            background: rgba(50,50,50, 0.1);
            border: none;
            padding: 5px 20px;
            border-left: 2px solid #73879C;
        }
        [class^="stat-"] {
            text-align: left;
            display: block;
            color: #73879C;
        }
        .stat-value {
            font-size: 40px;
        }
        .picker-control {
            width: 100%;
            height: 100%;
            background: rgba(50,50,50, 0.1);
            border: none;
            padding: 5px 20px;
            border-left: 2px solid #73879C;
            border-right: 1px solid #73879C;
        }
        [class^="control-"] {
            text-align: left;
            display: block;
            color: #73879C;
        }
        .control-value {
            font-size: 40px;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#calendar').datepicker( {
                format: 'dd-mm-yyyy',
                minViewMode: 1,
                maxViewMode: 3
            });
            $('#calendar').on("changeDate", function() {
                $('#date-selection').val(
                        $('#calendar').datepicker('getFormattedDate')
                );
            });

            var data = {
                labels: [
                    "Red",
                    "Blue",
                    "Yellow"
                ],
                datasets: [
                    {
                        data: [300, 50, 100],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"
                        ],
                        hoverBackgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"
                        ]
                    }]
            };

            var myPieChart = new Chart($('#overall-contribution'),{
                type: 'pie',
                data: data,
                animation:{
                    animateScale:true
                }
            });
        })
    </script>
@endsection