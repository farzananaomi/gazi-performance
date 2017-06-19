@extends('layouts.base')

@section('content-header')
    <h1>
        Product Prices for <strong>{{ "$header->month, $header->year" }}</strong>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('products.prices.index') }}"><i class="fa fa-money"></i> Product Price List</a></li>
        <li class="active">Product Prices View</li>
    </ol>
@endsection

@section('content')
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="#products" aria-controls="products" role="tab" data-toggle="tab">Products
                        View</a></li>
                <li role="presentation"><a href="#group" aria-controls="group" role="tab" data-toggle="tab">Group
                        View</a></li>
                <li role="presentation"><a href="#subgroup" aria-controls="subgroup" role="tab" data-toggle="tab">Subgroup
                        View</a></li>
            </ul>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="products">
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
                                    @foreach($prices as $product)
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
                                            <td style="background: #d3d3d3">Tk. {{ $product->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="group">
                    <?php $prds = $prices->groupBy('product_group_id'); ?>
                    @foreach(collect($groups)->chunk(2) as $chunks)
                        <div class="row">
                            @foreach($chunks as $id => $group)
                                <div class="col-md-6 col-xs-12">
                                    <div class="box box-default">
                                        <div class="box-header">
                                            <div class="box-title">{{ $group }}</div>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                                <div class=table-responsive>
                                                    <table class="table table-hover"
                                                           id="{{ str_slug($group) }}{{ $id }}products-table">
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
                                                        @foreach($prds->get($id) as $product)
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
                                                                <td style="background: #d3d3d3">
                                                                    Tk. {{ $product->price }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane" id="subgroup">
                    <?php $prds = $prices->groupBy('product_sub_group_id'); ?>

                    @foreach(collect($subgroups)->chunk(2) as $chunks)
                        <div class="row">
                            @foreach($chunks as $id => $group)
                                <div class="col-md-6 col-xs-12">
                                    <div class="box box-default">
                                        <div class="box-header">
                                            <div class="box-title">{{ $group }}</div>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="box-body">
                                            <div class=table-responsive>
                                                <table class="table table-hover"
                                                       id="{{ str_slug($group) }}{{ $id }}products-table">
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
                                                    @foreach($prds->get($id) as $product)
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
                                                            <td style="background: #d3d3d3">Tk. {{ $product->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @parent
    <style>
        .nav-tabs {
            background: rgba(0, 0, 0, 0.1);
        }

        .nav-tabs > li > a {
            border-radius: 0;
        }

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

            @foreach($groups as $id => $group)
                $('#{{ str_slug($group) }}{{ $id }}products-table').DataTable({
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
            @endforeach
            @foreach($subgroups as $id => $group)
                $('#{{ str_slug($group) }}{{ $id }}products-table').DataTable({
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
            @endforeach
        })
    </script>
@endsection