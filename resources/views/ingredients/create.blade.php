@extends('layouts.base')

@section('content-header')
    <h1>
        Add Ingredient
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('ingredients.index') }}"><i class="fa fa-asterisk"></i> Ingredient List</a></li>
        <li class="active">Add Ingredient</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Ingredient</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('ingredients.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @include('partials.bs_text', ['name' => 'name', 'label' => 'Ingredient Name', 'placeholder' => 'e.g. CaCO3', 'useOld' => ''])
                        @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => ''])
                        @include('partials.bs_number', ['name' => 'price', 'label' => 'Price', 'placeholder' => '', 'useOld' => '', 'step' => '0.01'])
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block" style="display: inline-block; width: 50%;">Save</button>

                        <a href="{{ route('ingredients.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection