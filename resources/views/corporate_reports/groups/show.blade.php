@extends('corporate_reports.base')

@section('reports-content')
    @parent

    <div class="row" style="margin-top: 35px;">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sales Contribution - {{ $group->name }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <canvas id="overview-group-contribution" width="400" height="200"></canvas>
                </div>
                <div class=table-responsive><table class="table ">
                    <thead>
                    <tr>
                        <th rowspan="2">Name</th>
                        <th colspan="2" style="text-align: center;">Sales (Tk.)</th>
                        <th colspan="2" style="text-align: center;">Sales (Amount)</th>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <th>% Overall</th>
                        <th>Total</th>
                        <th>% Overall</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>Tk. {{ number_format($group->cash, 2) }}</td>
                        <td>{{ number_format($group->cash*100/$totalSalesCash, 2) }} %</td>
                        <td>{{ $group->amount }}</td>
                        <td>{{ number_format($group->amount*100/$totalSalesQuantity, 2) }} %</td>
                    </tr>
                    </tbody>
                </table></div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ingredients Used</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class=table-responsive><table class="table ">
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

    <div class="row" style="margin-top: 15px;">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Products List</strong></h3>
                    <div class="box-tools pull-right">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        {{--<span class="label label-primary">Label</span>--}}
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class=table-responsive><table class="table table-hover no-wrap" id="products-table" style="width: 100%;">
                        <thead>
                        <tr>
                            <th colspan="5" style="border-top: 2px solid #f4f4f4;"></th>
                            <th colspan="2" style="text-align: center;border-top: 2px solid #f4f4f4;">Group</th>
                            <th colspan="2" style="text-align: center;border-top: 2px solid #f4f4f4;">Overall</th>
                            <th style="border-top: 2px solid #f4f4f4;"></th>
                        </tr>
                        <tr style="border-bottom: 2px solid #f4f4f4;">
                            <th>Code</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Sales (Tk.)</th>
                            <th>Sales (Amount)</th>

                            <th>% Tk.</th>
                            <th>% Amount</th>

                            <th>% Tk.</th>
                            <th>% Amount</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->color }}</td>

                                <td>Tk. {{ number_format($product->cash, 2) }}</td>
                                <td>{{ number_format($product->amount, 2) }}</td>

                                <td>{{ $group->cash == 0? '--':number_format($product->cash*100/$group->cash, 2) }}</td>
                                <td>{{ $group->amount == 0? '--':number_format($product->amount*100/$group->amount, 2) }}</td>

                                <td>{{ number_format($product->cash*100/$totalSalesCash, 2) }}</td>
                                <td>{{ number_format($product->amount*100/$totalSalesQuantity, 2) }}</td>
                                <th>
                                    <a href="{{ route('corporate.reports.products.show', [$product->product_id, 'month' => $queryMonth, 'year' => $queryYear, ]) }}">View</a>
                                </th>
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
        th, td {
            border: 1px solid #f4f4f4;
        }
        .box>.table tr th:first-of-type, .box>.table tr td:first-of-type {
            padding-left: 25px;
        }

        .box>.table tr th:last-of-type, .box>.table tr td:last-of-type {
            padding-right: 15px;
        }
        .table thead th {
            vertical-align: middle !important;
            border: 1px solid #f4f4f4 !important;
            border-bottom-width: 2px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            jQuery.extend(jQuery.fn.dataTableExt.oSort, {
                "currency-pre": function (a) {
                    return parseFloat(a.replace(/Tk.\s?/gi, '').replace(/,/gi, ''));
                },
                "currency-asc": function (a, b) {
                    return a - b;
                },
                "currency-desc": function (a, b) {
                    return b - a;
                }
            });

            var productsTable = $('#products-table').DataTable({
                "responsive": true,
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                // Disable sorting on the first column
                "aoColumnDefs" : [ {
                    'bSortable' : false,
                    'aTargets' : [ -1 ]
                }, {
                    "sType": "currency",
                    'aTargets': [3]
                } ]
            });


            var groupData = {
                labels: ["{{ $group->name }}", 'Others'],
                datasets: [
                    {
                        label: "Contribution (Tk.)",
                        data: [{!! $group->cash !!}, {!! $totalSalesCash - $group->cash !!}],
                        backgroundColor: [
                            "#e67e22",
                            "#95a5a6"
                        ],
                        hoverBackgroundColor: [
                            "#e67e22",
                            "#95a5a6"
                        ]
                    },
                    {
                        label: "Contribution (Amount)",
                        data: [{!! $group->amount !!}, {!! $totalSalesQuantity - $group->amount !!}],
                        backgroundColor: [
                            "#e67e22",
                            "#95a5a6"
                        ],
                        hoverBackgroundColor: [
                            "#e67e22",
                            "#95a5a6"
                        ]
                    }]
            };

            try {
                var groupCashContribution = new Chart($('#overview-group-contribution'),{
                    type: 'pie',
                    data: groupData
                });
            } catch (e) {

            }

        });
    </script>
@endsection