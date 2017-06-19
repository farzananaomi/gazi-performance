@extends('layouts.base')

@section('content-header')
    <h1>
        Overhead Cost List
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('overheads.index') }}"><i class="fa fa-circle-o"></i> Overheads</a></li>
        <li class="active">Overheads Cost List</li>
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
                        <form action="{{ route('overheads.costs.show', '') }}" method="get" id="overhead-chart-picker-form">
                            <input type="hidden" id="month-selection" name="month" required>
                            <input type="hidden" id="year-selection" name="year" required>
                            <button type="submit" id="overhead-chart-picker-search" class="btn btn-default col-md-6 col-xs-12"><i class="fa fa-search"></i> Show</button>
                            <button type="submit" id="overhead-chart-picker-create" class="btn btn-default col-md-6 col-xs-12"><i class="fa fa-plus"></i> Create</button>
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
                <div class=table-responsive><table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Chart Month/Year</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($charts as $chart)
                    <tr>
                        <td style="font-size: 18px;">
                            <a href="{{ route('overheads.costs.show', [$chart->id,'month' => $chart->month, 'year' => $chart->year]) }}"
                                    style="color: #000000 !important;">
                                {{ "{$chart->month}, $chart->year" }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('overheads.costs.show', [$chart->id,'month' => $chart->month, 'year' => $chart->year]) }}"
                               class="btn btn-link">View</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table></div>
            </div>
        </div>
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
            $('#overhead-chart-picker-form').on('submit', function () {
                updateDateFieldValues();
            });

            $("#overhead-chart-picker-create").click(function() {
                $(this).closest("form").attr("action", "{{ route('overheads.costs.create') }}");
            });
            $("#overhead-chart-picker-search").click(function() {
                $(this).closest("form").attr("action", "{{ route('overheads.costs.show', '') }}");
            });
        });
    </script>
@endsection