@extends('layouts.base')

@section('content-header')
    <h1>
        Update Ingredient
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('ingredients.index') }}"><i class="fa fa-asterisk"></i> Ingredient List</a></li>
        <li class="active">Update Ingredient</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Ingredient - {{ $ingredient->name }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('ingredients.update', [$ingredient->id]) }}" method="POST">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="box-body">
                        @include('partials.bs_text', ['name' => 'name', 'label' => 'Ingredient Name', 'placeholder' => 'e.g. CaCO3', 'useOld' => $ingredient->name])
                        @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => $ingredient->description])
                        @include('partials.bs_number', ['name' => 'price', 'label' => 'Price', 'placeholder' => '', 'useOld' => $ingredient->price, 'step' => '0.01'])
                    <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block" style="display: inline-block; width: 50%;">Update</button>

                        <a href="{{ route('ingredients.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection