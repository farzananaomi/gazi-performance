@extends('corporate_reports.base')

@section('reports-content')
    @parent
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-4 col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Product Details of <strong>{{ $product->name }}</strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body form-horizontal">
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
                    <div class=table-responsive><table class="table table-bordered table-centered">
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

                </div>

            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Ingredients Cost Breakdown</h3>
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
                            <th>{{ $totalWeight > 0?number_format($totalCost/($totalWeight*0.95), 2) : '--' }}</th>
                        </tr>
                        </tfoot>
                    </table></div>
                </div>
            </div>


            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Markup Comparision</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class=table-responsive><table class="table">
                        <thead>
                        <tr>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Cost / Kg</th>
                                <td>Tk. {{ $totalWeight > 0? number_format($costPerKg = $totalCost/($totalWeight*0.95), 2) : '--' }}</td>
                                <td class="vertical-divider"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Overhead / Kg</th>
                                <td>Tk. {{ $totalSalesWeight > 0? number_format($overheadPerKg = $totalOverheadCost/($totalSalesWeight), 2) : '--' }}</td>
                                <td class="vertical-divider"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Adjusted Cost / Kg</th>
                                <th>Tk. {{ number_format(@$costPerKg + @$overheadPerKg, 2) }}</th>
                                <th class="vertical-divider">Markup Price</th>
                                <th>Tk. {{ $product->price }}</th>
                            </tr>
                            <tr>
                                <th>Total Amount Sold</th>
                                <td>{{ $product->amount }}</td>
                                <td class="vertical-divider"></td>
                                <td>{{ $product->amount }}</td>
                            </tr>
                            <tr>

                                <th>Total Cost</th>
                                <th>Tk. {{ number_format((@$costPerKg + @$overheadPerKg)*$product->amount, 2) }}</th>
                                <th class="vertical-divider">Total Sale</th>
                                <th>Tk. {{ number_format($product->price*$product->amount, 2) }}</th>
                            </tr>
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
        .vertical-divider {
            border-left: 1px solid #ddd;
        }
    </style>
@endsection