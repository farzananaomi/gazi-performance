@extends('layouts.base')

@section('content-header')
    <h1>
        Add Product
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-asterisk"></i> Product List</a></li>
        <li class="active">Add Product</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Product</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            @include('partials.bs_text', ['name' => 'code', 'label' => 'Product Code', 'placeholder' => 'e.g. PI0001', 'useOld' => ''])
                            @include('partials.bs_text', ['name' => 'name', 'label' => 'Product Name', 'placeholder' => 'e.g. 1.5 Inch Thread pipe', 'useOld' => ''])
                            @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => ''])

                            @include('partials.selectpicker', ['name' => 'product_group_id', 'label' => 'Product Group',
                                    'options' => $groups, 'useKeys' => true,
                                    'placeholder' => 'Select a Group',
                                    'size' => 'col s12', 'useOld' => '', 'row' => true])

                            @include('partials.selectpicker', ['name' => 'product_sub_group_id', 'label' => 'Product Sub-Group',
                                    'options' => $subgroups, 'useKeys' => true,
                                    'placeholder' => 'Select a Sub-Group',
                                    'size' => 'col s12', 'useOld' => '', 'row' => true])

                            @include('partials.selectpicker', ['name' => 'recipe_id', 'label' => 'Recipe',
                                                            'options' => $recipes, 'useKeys' => true,
                                                            'placeholder' => 'Select a Recipe',
                                                            'size' => 'col s12', 'useOld' => '', 'row' => true])
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'color', 'label' => 'Color', 'placeholder' => '', 'useOld' => ''])
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'standard', 'label' => 'Standard', 'placeholder' => '', 'useOld' => '', 'autocomplete' => $autocompletes['standards']])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'length', 'label' => 'Length', 'placeholder' => '', 'useOld' => ''])
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'weight', 'label' => 'Weight', 'placeholder' => '', 'useOld' => ''])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'min_thickness', 'label' => 'Min Thickness', 'placeholder' => '', 'useOld' => ''])
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'max_thickness', 'label' => 'Max Thickness', 'placeholder' => '', 'useOld' => ''])
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('image')? 'has-error':'' }}">
                                @if($errors->has('image'))
                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img data-src="//placeholdit.imgix.net/~text?txtsize=33&txt=Product%0AImage&w=200&h=150"
                                             alt="Product Image"  src="//placeholdit.imgix.net/~text?txtsize=33&txt=Product%0AImage&w=200&h=150"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-default btn-file"><span
                                                    class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                                <input type="file" name="image">
                                            </span>
                                        <a href="#" class="btn btn-default fileinput-exists"
                                           data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>

                        <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="{{ asset('css/autocomplete.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('js/autocomplete.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
@endsection