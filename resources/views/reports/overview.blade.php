@extends('reports.base')

@section('reports-content')
    @parent
    <div class="row" style="margin-top: 35px;">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
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
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr style="border-top: 2px solid #f4f4f4;">
                            <th></th>
                            <th colspan="2" style="text-align: center">Sales (Tk.)</th>
                            <th colspan="2" style="text-align: center">Quantity (Pcs)</th>
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
                            <td><a href="{{ route('reports.groups.show', [$group->id, 'month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType, ]) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
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

                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr style="border-top: 2px solid #f4f4f4;">
                        <th></th>
                        <th colspan="2" style="text-align: center">Sales (Tk.)</th>
                        <th colspan="2" style="text-align: center">Quantity (Pcs)</th>
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
                            <td>{{ $totalSalesCash > 0? number_format($group->cash*100/$totalSalesCash, 2):'--' }}</td>
                            <td>{{ $group->quantity }}</td>
                            <td>{{ $totalSalesQuantity > 0? number_format($group->quantity*100/$totalSalesQuantity, 2):'--' }}</td>
                            <td><a href="{{ route('reports.subgroups.show', [$group->id, 'month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType,  ]) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
                    <h3 class="box-title">Statistics Overview</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total Overhead </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">Tk. {{ number_format($totalOverheadCost, 2) }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Overhead (Per Kg) </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">Tk. {{ $overallSalesWeight > 0? number_format($totalOverheadCost/$overallSalesWeight, 2) : '--' }}</p>
                        </div>
                    </div>
                    <hr />

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Package Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">Tk. {{ number_format($salesHeader->package_commission, 2) }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Special Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">Tk. {{ number_format($salesHeader->special_commission, 2) }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Yearly Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">Tk. {{ number_format($salesHeader->year_commission, 2) }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static"><strong>Tk. {{ number_format($salesHeader->package_commission + $salesHeader->special_commission + $salesHeader->year_commission, 2) }}</strong></p>
                        </div>
                    </div>

                    <hr />
                    <?php
                    $adjustedSales = ($totalSalesCash);
                    $pvRatio = ($overallSalesWeight > 0 && $adjustedSales > 0)? ($adjustedSales - ($variableOverheadCost*$totalSalesWeight/$overallSalesWeight))/$adjustedSales : 0;
                    $bep = ($overallSalesWeight > 0 && $pvRatio > 0)? ($fixedOverheadCost*$totalSalesWeight/$overallSalesWeight) / $pvRatio : 0;
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">PV Ratio </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">{{ number_format($pvRatio*100, 2) }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">BEP </label>
                        <div class="col-sm-8">
                            <p class="form-control-static">Tk. {{ number_format($bep*100, 2) }}</p>
                        </div>
                    </div>

                    <hr />
                    <div class="form-group">
                        <label class="col-sm-12 control-label" style="text-align: left;">Overhead Breakdown</label>
                        <div class="col-sm-12">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Variable</th>
                                        <th>Fixed</th>
                                        <th>Others</th>
                                        <th style="background-color: #e2e2e2;">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Tk. {{ number_format($variableOverheadCost, 2) }}</td>
                                        <td>Tk. {{ number_format($fixedOverheadCost, 2) }}</td>
                                        <td>Tk. {{ number_format($totalOverheadCost - $fixedOverheadCost - $variableOverheadCost, 2) }}</td>
                                        <td style="background-color: #e2e2e2;">Tk. {{ number_format($totalOverheadCost, 2) }}</td>
                                    </tr>
                                    <tr style="background-color: #e2e2e2;">
                                        <th>Total Sales Weight</th>
                                        <td colspan="4" style="text-align: center">{{ number_format($overallSalesWeight, 2) }} Kg</td>
                                    </tr>
                                    <tr>
                                        <th>(Per Kg)</th>
                                        <td>Tk. {{ $overallSalesWeight > 0? number_format($variableOverheadCost/$overallSalesWeight, 2) : '--' }}</td>
                                        <td>Tk. {{ $overallSalesWeight > 0? number_format($fixedOverheadCost/$overallSalesWeight, 2) : '--' }}</td>
                                        <td>Tk. {{ $overallSalesWeight > 0? number_format(($totalOverheadCost - $fixedOverheadCost - $variableOverheadCost)/$overallSalesWeight, 2) : '--' }}</td>
                                        <td style="background-color: #e2e2e2;">Tk. {{ $overallSalesWeight > 0? number_format($totalOverheadCost/$overallSalesWeight, 2) : '--' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
                    <h3 class="box-title">Ingredients Used</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Price / Kg</th>
                        <th>Quantity (Kg)</th>
                        <th>Total Price</th>
                        </thead>
                        <tbody>
                        <?php $totalIngredientCost = 0; ?>
                        @foreach($ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->name }}</td>
                                <td>Tk. {{ $ingredient->price }}</td>
                                <td>{{ $ingredient->usedQuantity > 0? $ingredient->usedQuantity:'0' }} Kg</td>
                                <td>Tk. {{ $cost = $ingredient->usedQuantity*$ingredient->price, $totalIngredientCost += $cost }}</td>
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
                    </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
                    <h3 class="box-title">Top Products by Sales (Tk.)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                <div class="table-responsive">
                <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Color</th>
                        <th>Sales (Tk.)</th>
                        <th>% Sales (Tk.)</th>
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
                        <td>{{ $totalSalesCash > 0? number_format($product->cash*100/$totalSalesCash, 2) : '--' }} %</td>
                        <td><a href="{{ route('reports.products.show', [$product->product_id, 'month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType,]) }}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
                    <h3 class="box-title">Top Products by Sales (Quantity (Pcs))</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Color</th>
                        <th>Sales (Quantity (Pcs))</th>
                        <th>% (Quantity (Pcs))</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topQuantityProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $totalSalesQuantity > 0? number_format($product->quantity*100/$totalSalesQuantity, 2):'' }} %</td>
                            <td><a href="{{ route('reports.products.show', [$product->product_id, 'month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType, ]) }}">View</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
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
    #overview-group-contribution, #overview-sub-group-contribution {
        height: 300px;
        width: 100%;
    }

    @media screen and (max-width: 480px) {
        #overview-group-contribution, #overview-sub-group-contribution {
            height: 600px;
            width: auto;
        }
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
                        label: "Contribution (Quantity (Pcs))",
                        data: {!! json_encode($subgroups->pluck('quantity')) !!},
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
                    responsive: true
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
                    responsive: true
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