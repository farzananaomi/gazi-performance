@extends('corporate_reports.base')

@section('reports-content')
    @parent
    <div class="row" style="margin-top: 35px;">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales Contribution - Group</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
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
                            <th colspan="2" style="text-align: center">Amount</th>
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
                            <td>{{ number_format($group->cash*100/$totalSalesCash, 2) }}</td>
                            <td>{{ $group->amount }}</td>
                            <td>{{ number_format($group->amount*100/$totalSalesQuantity, 2) }}</td>
                            <td><a href="{{ route('corporate.reports.groups.show', [$group->id, 'month' => $queryMonth, 'year' => $queryYear, ]) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table></div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales Contribution - Sub-Group</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <canvas id="overview-sub-group-contribution"></canvas>
                </div>
                <!-- /.box-body -->
                <div class=table-responsive><table class="table">
                    <thead>
                    <tr style="border-top: 2px solid #f4f4f4;">
                        <th></th>
                        <th colspan="2" style="text-align: center">Sales (Tk.)</th>
                        <th colspan="2" style="text-align: center">Amount</th>
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
                    @foreach($subgroups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>Tk. {{ number_format($group->cash, 2) }}</td>
                            <td>{{ number_format($group->cash*100/$totalSalesCash, 2) }}</td>
                            <td>{{ $group->amount }}</td>
                            <td>{{ number_format($group->amount*100/$totalSalesQuantity, 2) }}</td>
                            <td><a href="{{ route('corporate.reports.subgroups.show', [$group->id, 'month' => $queryMonth, 'year' => $queryYear, ]) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Statistics Overview</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total Overhead Cost</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">Tk. {{ $totalOverheadCost }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total Product Weight</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">{{ $totalSalesWeight }} Kg</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Overhead Cost / Kg</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">Tk. {{ number_format($totalOverheadCost/$totalSalesWeight, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ingredients Used</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class=table-responsive><table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Price / Kg</th>
                        <th>Amount</th>
                        <th>Total Price</th>
                        </thead>
                        <tbody>
                        <?php $totalIngredientCost = 0; ?>
                        @foreach($ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->name }}</td>
                                <td>Tk. {{ $ingredient->price }}</td>
                                <td>{{ $ingredient->usedAmount > 0? $ingredient->usedAmount:'0' }} Kg</td>
                                <td>Tk. {{ $cost = $ingredient->usedAmount*$ingredient->price, $totalIngredientCost += $cost }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total Cost</th>
                            <th></th>
                            <th></th>
                            <th>Tk. {{ $totalIngredientCost }}</th>
                        </tr>
                        </tfoot>
                    </table></div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Top Products by Sales (Tk.)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class=table-responsive><table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Color</th>
                            <th>Sales (Tk.)</th>
                            <th>%</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topCashProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->color }}</td>
                                <td>Tk. {{ number_format($product->cash, 2) }}</td>
                                <td>{{ number_format($product->cash*100/$totalSalesCash, 2) }}</td>
                                <td><a href="{{ route('corporate.reports.products.show', [$product->product_id, 'month' => $queryMonth, 'year' => $queryYear, ]) }}">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Top Products by Sales (Amount)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <div class=table-responsive><table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Color</th>
                            <th>Sales (Amount)</th>
                            <th>%</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topAmountProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->color }}</td>
                                <td>{{ $product->amount }}</td>
                                <td>{{ number_format($product->amount*100/$totalSalesQuantity, 2) }}</td>
                                <td><a href="{{ route('corporate.reports.products.show', [$product->product_id, 'month' => $queryMonth, 'year' => $queryYear, ]) }}">View</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table></div>
                </div>
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
    #overview-sub-group-contribution {
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
                        data: {!! json_encode($groups->pluck('amount')) !!},
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

            var subgroupData = {
                labels: {!! json_encode($subgroups->pluck('name')) !!},
                datasets: [
                    {
                        label: "Contribution (Tk.)",
                        data: {!! json_encode($subgroups->pluck('cash')) !!},
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
                        label: "Contribution (Amount)",
                        data: {!! json_encode($subgroups->pluck('amount')) !!},
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


            try {
                var subgroupCashContribution = new Chart($('#overview-sub-group-contribution'),{
                type: 'pie',
                data: subgroupData,
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