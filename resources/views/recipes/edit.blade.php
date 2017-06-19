@extends('layouts.base')

@section('content-header')
    <h1>
        Recipe New Recipe
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#"><i class="fa fa-list"></i> Recipe List</a></li>
        <li class="active">Add New Recipe</li>
    </ol>
@endsection

@section('content')
    <form role="form" action="{{ route('recipes.update', [$recipe->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="box">
                    <div class="box-body">

                        @include('partials.bs_text', ['name' => 'name', 'label' => 'Ingredient Name', 'placeholder' => 'e.g. CaCO3', 'useOld' => $recipe->name])
                        @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => $recipe->description])
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary col-md-4">Update</button>
                        <a href="{{ route('recipes.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Recipe Ingredients</h3>
                    </div>

                    <div class="box-body">
                        <div class=table-responsive><table class="table">
                            <thead>
                            <tr>
                                <th data-field="id">Name</th>
                                <th data-field="price">Quantity</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody data-bind="foreach : selectedItems">
                            <tr>
                                <input type="hidden" data-bind="value: id, attr: { name: idField }">
                                <td data-bind="text: name"></td>
                                <td>
                                    <input type="number" class="validate recipe-item-input" min="0" step="0.001"
                                           data-bind="value: quantity, attr: { name: quantityField }"> Kg
                                </td>
                                <td><i class="tiny material-icons" data-bind="click : toggleIngredient"
                                       style="cursor: pointer">delete</i></td>
                            </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Weight</th>
                                    <th data-bind="text: totalWeight"></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-12">
                <div class="box box-default">
                    <div class="box-header">
                        @include('partials.bs_text', ['name' => 'searchIngredients', 'label' => 'Search Ingredients',
                                'size' => 'col s12', 'extras' => 'data-bind="value: filter, valueUpdate: \'afterkeydown\'"'])
                    </div>

                    <ul class="list-group">
                        <!-- ko foreach: filteredItems -->
                        <li class="list-group-item">
                            <input type="checkbox" data-bind="checked: selected, click : toggleIngredient" />
                            <label data-bind="text: name, click : toggleIngredient" ></label>
                        </li>
                        <!-- /ko -->
                    </ul>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('styles')
    <style>
        .table > tbody > tr > td {
            vertical-align: middle;
        }

        .recipe-item-input {
            padding: 4px 8px;
        }
    </style>
@endsection


@section('scripts')

    <script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js"></script>

    <?php
    foreach ($ingredients as $ingredient) {
        $ingredient->selected = old("ingredients.{$ingredient->id}", $ingredient->selected);
        $ingredient->quantity = old("quantities.{$ingredient->id}", $ingredient->quantity);
    }
    ?>
    <script>
        function Ingredient(item) {
            this.selected = ko.observable(item.selected);
            this.id = item.id;
            this.name = ko.observable(item.name);
            this.quantity = ko.observable(item.quantity);
            this.idField = 'ingredients[' + item.id + ']';
            this.quantityField = 'quantities[' + item.id + ']';
            return this;
        }

        function RecipeIngredientsModel() {
            var self = this;

            self.filter = ko.observable("");

            var rawData = {!! json_encode($ingredients) !!};
            self.ingredients = ko.observableArray(ko.utils.arrayMap(rawData, function(item) {
                return new Ingredient(item);
            }));

            self.toggleIngredient = function(ingredient){
                ingredient.selected(!ingredient.selected());
            };

            self.filteredItems = ko.computed(function() {
                var filter = self.filter().toLowerCase();
                if (!filter) {
                    return this.ingredients();
                } else {
                    return ko.utils.arrayFilter(self.ingredients(), function(item) {
                        return item.name().toLowerCase().indexOf(filter) !== -1;
                    });
                }
            }, self);

            self.selectedItems = ko.computed(function() {
                return ko.utils.arrayFilter(self.ingredients(), function(item) {
                    return item.selected();
                });
            }, self);

            self.totalWeight = ko.computed(function () {
                let i = 0, total = 0;
                let ingredients = ko.utils.arrayFilter(self.ingredients(), function (item) {
                    return item.selected();
                });

                for (i = 0; i < ingredients.length; i++) {
                    total += Number(ingredients[i].quantity());
                }

                return total.toString() + " Kg";

            }, self);
        }
        ko.applyBindings(RecipeIngredientsModel);
    </script>
@endsection