@extends('layouts.base')

@section('content-header')
    <h1>
        Product Prices for <strong>{{ request('month').', '.request('year') }}</strong>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('products.prices.index') }}"><i class="fa fa-money"></i> Product Price List</a></li>
        <li class="active">Create Product Prices</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('products.prices.store') }}" method="post" id="products-prices-form">
        {!! csrf_field() !!}
        <input type="hidden" name="month" value="{{ request('month') }}">
        <input type="hidden" name="year" value="{{ request('year') }}">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Save</button>
                                    <button type="submit"  class="btn btn-info"><i class="fa fa-save"></i> Draft</button>
                                    <a href="{{ route('products.prices.show') }}" class="btn btn-default">Cancel</a>
                                </div>
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
                    <div class="box-title">All Products List</div>
                </div>
                <div class="box-body">
                    <div class=table-responsive>
                        <table class="table table-hover" id="products-table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Group</th>
                                <th>Sub-Group</th>
                                <th>Standard</th>
                                <th>Color</th>
                                <th>Weight</th>
                                <th style="background: #d3d3d3">Price</th>
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
                                    <td>{{ $product->group->name }}</td>
                                    <td>{{ $product->subgroup->name }}</td>
                                    <td>{{ $product->standard }}</td>
                                    <td>{{ $product->color }}</td>
                                    <td>{{ $product->weight }} Kg</td>
                                    <td>Tk. <input type="number"  min="0" step="0.01" class="{{ $errors->has('prices.'.$product->id)? 'error':'' }}" name="prices[{{ $product->id }}]" value="{{ old('prices.'.$product->id, '') }}"/></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('styles')
    <style>
        .error {
            border: 1px solid red;
        }
    </style>
@endsection

@section('scripts')
    <script>
//        $(document).ready(function () {
//            var productsTable = $('#products-table').DataTable({
//                "paging": true,
//                "lengthChange": true,
//                "searching": true,
//                "ordering": true,
//                "info": true,
//                "autoWidth": false,
//                "aoColumnDefs" : [ {
//                    'bSortable' : false,
//                    'aTargets' : [ 0 ]
//                }, {
//                    'bSortable' : false,
//                    'aTargets' : [ -1 ]
//                } ]
//            });
//
//            $('#products-prices-form').on('submit', function () {
//                productsTable
//                        .search('')
//                        .columns()
//                        .search('');
//                productsTable.page.len(999999999);
//                productsTable.draw();
//                  productsTable.$('input').serialize();
//            });
//        });
    </script>
@endsection