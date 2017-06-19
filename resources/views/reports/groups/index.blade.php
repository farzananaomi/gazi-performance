@extends('reports.base')

@section('reports-content')
    @parent

    <div class="row" style="margin-top: 35px;">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales Contribution - Group</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <canvas id="overview-group-contribution"></canvas>
                </div>
                <!-- /.box-body -->
                <div class=table-responsive><table class="table">
                    <thead>
                    <tr style="border-top: 2px solid #f4f4f4;">
                        <th></th>
                        <th colspan="2" style="text-align: center">Sales (Tk.)</th>
                        <th colspan="2" style="text-align: center">Quantity</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Tk.</th>
                        <th>%</th>
                        <th>Pcs</th>
                        <th>%</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>Tk. {{ number_format($group->cash, 2) }}</td>
                            <td>{{ $totalSalesCash > 0? number_format($group->cash*100/$totalSalesCash, 2):'--' }}</td>
                            <td>{{ $group->quantity }}</td>
                            <td>{{ $totalSalesQuantity > 0? number_format($group->quantity*100/$totalSalesQuantity, 2):'--' }}</td>
                            <td><a href="{{ route('reports.groups.show', [$group->id, 'month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType ]) }}">View</a></td>
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
        .box>.table tr th:first-of-type, .box>.table tr td:first-of-type {
            padding-left: 25px;
        }

        .box>.table tr th:last-of-type, .box>.table tr td:last-of-type {
            padding-right: 15px;
        }
        #overview-group-contribution {
            height: 300px;
            width: 100% !important
        }
    </style>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            var groupData = {
                labels: {!! json_encode($groups->pluck('name')) !!},
                datasets: [
                    {
                        data: {!! json_encode($groups->pluck('cash')) !!},
                        backgroundColor: [
                            "#27ae60",
                            "#2980b9",
                            "#8e44ad",
                            "#2c3e50",
                            "#f1c40f",
                            "#d35400",
                            "#c0392b"
                        ],
                        hoverBackgroundColor: [
                            "#27ae60",
                            "#2980b9",
                            "#8e44ad",
                            "#2c3e50",
                            "#f1c40f",
                            "#d35400",
                            "#c0392b"
                        ]
                    },
                    {
                        data: {!! json_encode($groups->pluck('quantity')) !!},
                        backgroundColor: [
                            "#27ae60",
                            "#2980b9",
                            "#8e44ad",
                            "#2c3e50",
                            "#f1c40f",
                            "#d35400",
                            "#c0392b"
                        ],
                        hoverBackgroundColor: [
                            "#27ae60",
                            "#2980b9",
                            "#8e44ad",
                            "#2c3e50",
                            "#f1c40f",
                            "#d35400",
                            "#c0392b"
                        ]
                    }]
            };

            try {
                var groupCashContribution = new Chart($('#overview-group-contribution'),{
                    type: 'pie',
                    data: groupData,
                    option: {
                        maintainAspectRatio: true,
                        responsive: false
                    },
                    animation:{
                        animateScale:true,
                        animateRotate: true
                    }
                });
            } catch (e) {

            }
        });
    </script>
@endsection