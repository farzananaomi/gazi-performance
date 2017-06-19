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
        <div class="col-md-4 col-xs-12">
            <div class="box box-solid bg-green-gradient">
                <div class="box-header">
                    <i class="fa fa-calendar"></i>

                    <h3 class="box-title">Calendar</h3>
                    <!-- tools box -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%" data-date="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" data-date-end-date="0d">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-black">
                    <div class="row">
                        <div class="col-xs-12">
                        <form action="{{ route('reports.overview') }}" method="get" id="report-picker-form">
                            <input type="hidden" id="month-selection" name="month">
                            <input type="hidden" id="year-selection" name="year">
                            <button type="submit" id="report-picker-submit" class="btn btn-default btn-block"><i class="fa fa-search"></i> Show</button>
                        </form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                    <div class="box-title">Listed Reports</div>
                </div>
                <div class="table-responsive">
<table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Report Month/Year</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td style="font-size: 18px;">
                            <a href="{{ route('reports.overview', ['month' => $report->month, 'year' => $report->year]) }}"
                                    style="color: #000000 !important;">
                                {{ "{$report->month}, $report->year" }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('reports.overview', ['month' => $report->month, 'year' => $report->year]) }}"
                               class="btn btn-link"><i class="fa fa-street-view"></i> Retail Report</a>
                        </td>
                        <td>
                            <a href="{{ route('reports.overview', ['month' => $report->month, 'year' => $report->year, 'report-type' => 'corporate']) }}"
                               class="btn btn-link"><i class="fa fa-building"></i> Corporate Report</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="data-not-available-modal" tabindex="-1" role="dialog" aria-labelledby="data-not-available-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Data Not Available</h4>
                </div>
                <div class="modal-body">
                    <p>Complete Data Not available to generate a report. Please check if Product Prices Chart, Sales Chart & Overhead Costs Charts have been uploaded.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('styles')
    @parent
    <style>
        #calendar th span:hover, #calendar td span:hover {
            background: rgba(0,0,0,0.2) !important;
        }
        #calendar td span.active {
            color: #ffffff;
            background: rgba(0,0,0,0.5);
            border-color: #285e8e;
        }
        #calendar .datepicker, #calendar .datepicker table {
            width: 100% !important;
        }

        #calendar td span.active, #calendar td span.focused {
            background: #00a65a;
        }
        #calendar td span {
            font-size: 18px;
        }
        #calendar td span.active {
            color: #ffffff;
            background: rgba(0,0,0,0.5);
        }
        .datepicker-switch, .next, .prev {
            font-size: 24px !important;
        }
        .datepicker-switch:hover, .next:hover, .prev:hover {
            background: rgba(0,0,0,0.2) !important;
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
        }

        $(document).ready(function() {
            $('#calendar').datepicker( {
                format: 'dd-mm-yyyy',
                minViewMode: 1,
                maxViewMode: 3
            });
            $('#calendar').on("changeDate", function() {
                updateDateFieldValues();
            });
            $('#report-picker-form').on('submit', function () {
                updateDateFieldValues();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            @if (!session('data_available', true))
                $('#data-not-available-modal').modal();

            @endif
        });
    </script>
@endsection