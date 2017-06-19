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
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <span class="stat-title">Report of Month/Year</span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <button class="picker-control" data-toggle="modal" data-target="#report-picker">
                        <span class="control-label">  Month</span>
                        <span class="control-value"><i class="fa fa-calendar"></i> {{ $queryMonth }}</span>
                    </button>
                </div>
                <div class="col-xs-6">
                    <button class="picker-control" data-toggle="modal" data-target="#report-picker">
                        <span class="control-label">  Year</span>
                        <span class="control-value"><i class="fa fa-calendar-check-o"></i> {{ $queryYear }}</span>
                    </button>
                </div>
            </div>
            <div class="row second-row" style="margin-top: 35px">
                <div class="col-md-6 col-xs-12">
                    <button class="picker-control" data-toggle="modal" data-target="#sector-picker">
                        <span class="control-label">Sector</span>
                        <span class="control-value"><i class="fa fa-circle-o"></i> {{ ucfirst($reportType) }}</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <span class="stat-title">Overall Stats</span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="stat-box">
                        <span class="stat-label">Total Sales (Tk.)</span>
                        <span class="stat-value fit-text" title="{{ $totalSalesCash }}"><i
                                    class="fa fa-money"></i> Tk. {{ number_format($totalSalesCash - ($salesHeader->package_commission + $salesHeader->special_commission + $salesHeader->year_commission), 2) }}</span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="stat-box">
                        <span class="stat-label">Total Sales (Pcs)</span>
                        <span class="stat-value fit-text" title="{{ $totalSalesQuantity }}"><i class="material-icons">shopping_basket</i> {{ $totalSalesQuantity }}</span>
                    </div>
                </div>
            </div>

            <div class="row second-row" style="margin-top: 35px">
                <div class="col-xs-6">
                    <div class="stat-box">
                        <span class="stat-label">Total Sales (Kg)</span>
                        <span class="stat-value fit-text" title="{{ $totalSalesWeight }}"><i
                                    class="fa fa-balance-scale"></i> {{ number_format($totalSalesWeight, 2) }} Kg</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 35px;">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li role="presentation" {!! request()->is('reports/overview*')? 'class="active"':'' !!}><a
                            href="{{ route('reports.overview', ['month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType]) }}">Overview</a>
                </li>
                <li role="presentation" {!! request()->is('reports/breakdown/groups*')? 'class="active"':'' !!}><a
                            href="{{ route('reports.groups.index', ['month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType]) }}">Breakdown
                        - Groups</a></li>
                <li role="presentation" {!! request()->is('reports/breakdown/subgroups*')? 'class="active"':'' !!}><a
                            href="{{ route('reports.subgroups.index', ['month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType]) }}">Breakdown
                        - Sub Groups</a></li>
                <li role="presentation" {!! request()->is('reports/breakdown/products*')? 'class="active"':'' !!}><a
                            href="{{ route('reports.products.index', ['month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType]) }}">Breakdown
                        - Products</a></li>
            </ul>
        </div>
    </div>

@section('reports-content')
@show

<div class="modal fade" id="report-picker" tabindex="-1" role="dialog" aria-labelledby="report-month-year-picker">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="report-month-year-picker">Select Report Month/Year</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"
                             data-date="{{ \Carbon\Carbon::parse("$queryMonth, $queryYear")->format('d-m-Y') }}"
                             data-date-end-date="0d">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="{{ route('reports.overview') }}" method="get" id="report-picker-form">
                    <input type="hidden" id="month-selection" name="month">
                    <input type="hidden" id="year-selection" name="year">
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                    <button type="submit" id="report-picker-submit" class="btn btn-primary btn-lg"
                            style="background: #00a65a;">Show
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sector-picker" tabindex="-1" role="dialog" aria-labelledby="sector-picker">
    <div class="modal-dialog" role="document">
        {{--<form action="{{ route('reports.overview') }}" method="get" id="report-sector-form">--}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="report-month-year-picker">Select Report Month/Year</h4>

                </div>
                <div class="modal-body">
                    <div class="btn-group" data-toggle="buttons-radio" style="width: 100%;">
                        <a class="btn btn-primary sector-picker" href="{{ route('reports.overview', ['month' => $queryMonth, 'year' => $queryYear, 'report-type' => 'retail']) }}">
                            Retail
                        </a>
                        <a type="submit" class="btn btn-primary sector-picker" href="{{ route('reports.overview', ['month' => $queryMonth, 'year' => $queryYear, 'report-type' => 'corporate']) }}">
                            Corporate
                        </a>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="month-selection" name="{{ $queryMonth }}">
                    <input type="hidden" id="year-selection" name="{{ $queryYear }}">
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
            </div>
        {{--</form>--}}
    </div>
</div>


@endsection

@section('styles')
    @parent
    <style>
        a.btn.btn-primary.sector-picker {
            width: 45%;
            margin: 0 5px;
            height: 100%;
            min-height: 80px;
            font-size: 34px;
            background: #00a65a !important;
            border-color: #00a65a !important;
            padding-top: 12px;
        }

        #calendar td span.active, #calendar td span.focused {
            color: #ffffff;
            background: #00a65a;
            font-size: 24px;
        }

        #calendar td span {
            font-size: 20px;
        }

        #calendar .datepicker, #calendar .datepicker table {
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
            min-height: 85px;
            background: rgba(50, 50, 50, 0.1);
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
            font-size: 30px;
        }

        .picker-control {
            width: 100%;
            height: 100%;
            min-height: 76px;
            background: rgba(50, 50, 50, 0.1);
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

        .nav-tabs {
            background: rgba(0, 0, 0, 0.1);
        }

        .nav-tabs > li > a {
            border-radius: 0;
        }

        @media screen and (max-width: 480px) {
            .second-row {
                margin-top: 0 !important;
            }

            .picker-control, .stat-box {
                margin-top: 15px !important;
                margin-bottom: 15px !important;
            }
        }
        .box-title.fa-minus:before,
        .box-title.fa-plus:before {
            display: none !important;
        }
        [data-widget="collapse"] {
            cursor: pointer !important;
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script>
        function updateDateFieldValues() {
            $('#month-selection').val(
                    $('#calendar').datepicker('getDate').getMonthName()
            );

            $('#year-selection').val(
                    $('#calendar').datepicker('getDate').getFullYear()
            );
        };

        function form_submit() {
            document.getElementById("report-sector-form").submit();
        }

        $(document).ready(function () {
            $('#calendar').datepicker({
                format: 'dd-mm-yyyy',
                minViewMode: 1,
                maxViewMode: 3
            });
            $('#calendar').on("changeDate", function () {
                updateDateFieldValues();
            });
            $('#report-picker-form').on('submit', function () {
                updateDateFieldValues();
            });
        });
    </script>
@endsection