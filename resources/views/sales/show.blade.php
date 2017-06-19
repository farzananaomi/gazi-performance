@extends('layouts.base')

@section('content-header')
    <h1>
        Sales Charts List
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Sales Charts List</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <h4 class="box-title">Sales Commissions</h4>
                </div>
                <div class="box-body form-horizontal">
                    <div class="form-group">
                        <label for="package_commission" class="col-sm-3 control-label">Package Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static" id="package_commission">Tk. {{ $sale->package_commission }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="special_commission" class="col-sm-3 control-label">Special Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static" id="special_commission">Tk. {{ $sale->special_commission }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="yearly_commission" class="col-sm-3 control-label">Yearly Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static" id="yearly_commission">Tk. {{ $sale->yearly_commission }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="yearly_commission" class="col-sm-3 control-label">Yearly Commission </label>
                        <div class="col-sm-8">
                            <p class="form-control-static" id="yearly_commission"><strong>Tk. {{ $sale->package_commission + $sale->special_commission + $sale->yearly_commission }}</strong></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Sales Data</h3>
                    <div class="box-body">
                        <div class="table-responsive">
                        <table class="table" id="products-table">
                            <thead>
                                <tr>
                                    <th colspan="8"></th>
                                    <th colspan="2">Sales Quantity (Pcs)</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Group</th>
                                    <th>Sub-Group</th>
                                    <th>Standard</th>
                                    <th>Color</th>
                                    <th>Weight</th>
                                    <th>Retail</th>
                                    <th>Corporate</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($sale->salesData as $product)
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
                                    <td>{{ $groups[$product->product_group_id] }}</td>
                                    <td>{{ $subgroups[$product->product_sub_group_id] }}</td>
                                    <td>{{ $product->standard }}</td>
                                    <td>{{ $product->color }}</td>
                                    <td>{{ $product->weight }} Kg</td>
                                    <td>{{ $product->retail_quantity }}</td>
                                    <td>{{ $product->corporate_quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7"></th>
                                    <th>Total</th>
                                    <th>{{ $sale->salesData->sum('retail_quantity') }}</th>

                                    <th>{{ $sale->salesData->sum('corporate_quantity') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @parent
    <style>
        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var productsTable = $('#products-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "aoColumnDefs" : [ {
                    'bSortable' : false,
                    'aTargets' : [ 0 ]
                } ]
            });
        });
    </script>
@endsection