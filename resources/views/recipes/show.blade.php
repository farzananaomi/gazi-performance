@extends('layouts.base')

@section('content-header')
    <h1>
        Recipe Details
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('recipes.index')  }}"><i class="fa fa-list"></i> Recipe List</a></li>
        <li class="active">Recipe View</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="box box-default">
            <div class="box-header">
                <h3 class="box-title">Recipe Details of <strong>{{ $recipe->name }}</strong></h3>
            </div>
            <div class="box-body form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $recipe->name }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">{{ $recipe->description }}</p>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('recipes.index') }}" class="btn btn-default">Go Back</a>
                <a href="{{ route('recipes.edit', [$recipe->id]) }}" class="btn btn-primary pull-right">Edit</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header">
                <h3 class="box-title">Recipe Ingredients</h3>
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
                        $totalWeight = $recipe->ingredients->sum('pivot.quantity');
                        $totalCost = $recipe->ingredients->sum(function($ingredient) {
                            return $ingredient->pivot->quantity*$ingredient->price;
                        });
                        $totalWeightPercentage = $recipe->ingredients->sum(function($ingredient) use($totalWeight) {
                            return $ingredient->pivot->quantity*100/$totalWeight;
                        });
                    ?>
                    @foreach($recipe->ingredients as $ingredient)
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
                    </tfoot>
                </table></div>
            </div>
        </div>
    </div>
</div>
@endsection