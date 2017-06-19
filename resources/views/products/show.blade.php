@extends('layouts.base')

@section('content-header')
    <h1>
        Product Details
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('products.index')  }}"><i class="fa fa-list"></i> Product List</a></li>
        <li class="active">Product View</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Product Details of <strong>{{ $product->name }}</strong></h3>
                </div>
                <div class="box-body form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Code</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">{{ $product->code }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">{{ $product->name }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">{{  empty($product->description)? '---': $product->description }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Recipe</label>
                        <div class="col-sm-2">
                            <p class="form-control-static">{{ $product->recipe->name }}</p>
                        </div>
                        <div class="col-sm-2">
                            <p class="form-control-static"><a href="{{ route('recipes.show', $product->recipe->id) }}"> View</a></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Standard</label>
                        <div class="col-sm-9">
                            <p class="form-control-static">{{  empty($product->standard)? '---': $product->standard }}</p>
                        </div>
                    </div>

                    <div class=table-responsive><table class="table table-bordered table-centered centered-header">
                        <thead>
                        <tr>
                            <th rowspan="2">Length</th>
                            <th colspan="2">Thickness</th>
                            <th rowspan="2">Weight</th>
                            <th rowspan="2">Color</th>
                        </tr>
                        <tr>
                            <th>Min</th>
                            <th>Max</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ empty($product->length)? '---': $product->length }}</td>
                            <td>{{ empty($product->min_thickness)? '---': $product->min_thickness }}</td>
                            <td>{{ empty($product->max_thickness)? '---': $product->max_thickness }}</td>
                            <td>{{ empty($product->weight)? '---': $product->weight }}</td>
                            <td>{{ empty($product->color)? '---': $product->color }}</td>
                        </tr>
                        </tbody>
                    </table></div>

                    <div>
                        @if(empty($product->image_path))
                            <img class="img-responsive img-rounded product-image" alt="Product Image"  src="//placeholdit.imgix.net/~text?txtsize=33&txt=Product%0AImage&w=200&h=150"/>
                        @else
                            <img class="img-responsive img-rounded product-image" src="{{ route('imagecache', ['medium', $product->image_path]) }}" alt="{{ $product->name }}">
                        @endif
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ route('products.index') }}" class="btn btn-default">Go Back</a>
                    <a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-primary pull-right">Edit</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Product Ingredients</h3>
                </div>
                <div class="box-body">
                    <div class=table-responsive><table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity / Kg</th>
                            <th>Price / Kg</th>
                            <th>Total Price</th>
                            <th>% of Total Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $totalWeight = $product->recipe->ingredients->sum('pivot.quantity');
                        $totalCost = $product->recipe->ingredients->sum(function($ingredient) {
                            return $ingredient->pivot->quantity*$ingredient->price;
                        });
                        $totalWeightPercentage = $product->recipe->ingredients->sum(function($ingredient) use($totalWeight) {
                            return $ingredient->pivot->quantity*100/$totalWeight;
                        });
                        ?>
                        @foreach($product->recipe->ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->name }}</td>
                                <td>{{ $ingredient->pivot->quantity  }} Kg</td>
                                <td>Tk. {{ $ingredient->price }}</td>
                                <td>Tk. {{ $ingredient->pivot->quantity*$ingredient->price }}</td>
                                <td>{{ $totalWeight > 0? number_format($ingredient->pivot->quantity*100/$totalWeight, 2) : '--'  }} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total</th>
                            <th>{{ $totalWeight }} Kg</th>
                            <th></th>
                            <th>Tk. {{ $totalCost }}</th>
                            <th>{{ $totalWeightPercentage }} %</th>
                        </tr>
                        <tr>
                            <th>Cost per Kg</th>
                            <th colspan="3"></th>
                            <th>{{ $totalWeight > 0? number_format($totalCost/$totalWeight, 2) : '--' }}</th>
                        </tr>
                        <tr>
                            <th>After Wastage 5%</th>
                            <th colspan="3"></th>
                            <th>{{ $totalWeight > 0? number_format($totalCost/($totalWeight*0.95), 2) : '--' }}</th>
                        </tr>
                        <tr style="border-top: 2px solid #2e2e2e;">
                            <th>Product Weight</th>
                            <th colspan="3"></th>
                            <td>{{ empty($product->weight)? '---': $product->weight }} Kg</td>
                        </tr>
                        <tr>
                            <th>Product Cost</th>
                            <th colspan="3"></th>
                            <th>{{ $totalWeight > 0?number_format($totalCost*$product->weight/($totalWeight*0.95), 2) : '--' }}</th>
                        </tr>
                        </tfoot>
                    </table></div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('styles')
    <style>
        .centered-header * {
            text-align: center;
        }
        .table thead th {
            vertical-align: middle !important;
            border: 1px solid #f4f4f4 !important;
            border-bottom-width: 2px;
        }
        .form-group {
            margin-bottom: 0;
        }
        .product-image {
            display: block;
            margin: 10px auto;
            background-color: #e2e2e2;
        }
    </style>
@endsection