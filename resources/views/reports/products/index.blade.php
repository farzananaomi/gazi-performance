@extends('reports.base')


@section('reports-content')
    @parent

    <div class="row" style="margin-top: 15px;">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Products List</strong></h3>
                    <div class="box-tools pull-right">
                        <a href="{{ route('reports.products.excel', ['month' => request('month'), 'year' => request('year')]) }}"
                           class="btn btn-info"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        {{--<span class="label label-primary">Label</span>--}}
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class=table-responsive><table class="table table-hover no-wrap" id="products-table" style="width: 100%;">
                        <thead>
                        {{--<tr>--}}
                        {{--<th colspan="5" style="border-top: 2px solid #f4f4f4;"></th>--}}
                        {{--<th colspan="2" style="text-align: center;border-top: 2px solid #f4f4f4;">Group</th>--}}
                        {{--<th colspan="2" style="text-align: center;border-top: 2px solid #f4f4f4;">Overall</th>--}}
                        {{--<th style="border-top: 2px solid #f4f4f4;"></th>--}}
                        {{--</tr>--}}
                        <tr style="border-bottom: 2px solid #f4f4f4;">
                            <th></th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Group</th>
                            <th>Sub-group</th>
                            <th>Sales (Tk.)</th>
                            <th>Sales (Pcs)</th>

                            {{--<th>% Tk.</th>--}}
                            {{--<th>% Quantity</th>--}}

                            <th>% Tk.</th>
                            <th>% Quantity (Pcs)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    @if(empty($product->image_path))
                                        <img src="https://placeholdit.imgix.net/~text?txtsize=12&txt={{ $product->id }}&w=55&h=55"
                                             alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ route('imagecache', ['small', $product->image_path]) }}" alt="{{ $product->name }}" class="product-image">
                                    @endif
                                </td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->color }}</td>
                                <td>{{ $product->group->name }}</td>
                                <td>{{ $product->subgroup->name }}</td>

                                <td>Tk. {{ number_format($product->cash, 2) }}</td>
                                <td>{{ number_format($product->quantity, 2) }}</td>

                                {{--<td>{{ $group->cash == 0? '--':number_format($product->cash*100/$group->cash, 2) }}</td>--}}
                                {{--<td>{{ $group->quantity == 0? '--':number_format($product->quantity*100/$group->quantity, 2) }}</td>--}}

                                <td>{{ $totalSalesCash > 0? number_format($product->cash*100/$totalSalesCash, 2) : '--' }} %</td>
                                <td>{{ $totalSalesQuantity > 0? number_format($product->quantity*100/$totalSalesQuantity, 2) : '--' }} %</td>
                                <th>
                                    <a href="{{ route('reports.products.show', [$product->id, 'month' => $queryMonth, 'year' => $queryYear, 'report-type' => $reportType]) }}">View</a>
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
            vertical-align: middle !important;
        }
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
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [-1]
                }, {
                    "sType": "currency",
                    'aTargets': [3]
                }]
            });
        });
    </script>
@endsection