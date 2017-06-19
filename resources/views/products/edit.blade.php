@extends('layouts.base')

@section('content-header')
    <h1>
        Edit Products - {{ $product->name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-asterisk"></i> Product List</a></li>
        <li class="active">Edit Product</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Product</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="box-body">
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            @include('partials.bs_text', ['name' => 'code', 'label' => 'Product Code', 'placeholder' => 'e.g. PI0001', 'useOld' => $product->code])
                            @include('partials.bs_text', ['name' => 'name', 'label' => 'Product Name', 'placeholder' => 'e.g. 1.5 Inch Thread pipe', 'useOld' => $product->name])
                            @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => ''])

                            @include('partials.selectpicker', ['name' => 'product_group_id', 'label' => 'Product Group',
                                    'options' => $groups, 'useKeys' => true,
                                    'placeholder' => 'Select a Group',
                                    'size' => 'col s12', 'useOld' => $product->product_group_id,
                                    'row' => true])

                            @include('partials.selectpicker', ['name' => 'product_sub_group_id', 'label' => 'Product Sub-Group',
                                    'options' => $subgroups, 'useKeys' => true,
                                    'placeholder' => 'Select a Sub-Group',
                                    'size' => 'col s12', 'useOld' =>  $product->product_sub_group_id, 'row' => true])

                            @include('partials.selectpicker', ['name' => 'recipe_id', 'label' => 'Recipe',
                                                            'options' => $recipes, 'useKeys' => true,
                                                            'placeholder' => 'Select a Recipe',
                                                            'size' => 'col s12', 'useOld' => $product->product_sub_group_id,
                                                            'row' => true])
                        </div>
                        <div class="col-lg-4 col-md-6 col-xs-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'color', 'label' => 'Color', 'placeholder' => '', 'useOld' => $product->color])
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'standard', 'label' => 'Standard', 'placeholder' => '', 'useOld' => $product->standard, 'autocomplete' => $autocompletes['standards']])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'length', 'label' => 'Length', 'placeholder' => '', 'useOld' => $product->length])
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'weight', 'label' => 'Weight', 'placeholder' => '', 'useOld' => $product->weight])
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'min_thickness', 'label' => 'Min Thickness', 'placeholder' => '', 'useOld' => $product->min_thickness])
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    @include('partials.bs_text', ['name' => 'max_thickness', 'label' => 'Max Thickness', 'placeholder' => '', 'useOld' => $product->max_thickness])
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('image')? 'has-error':'' }}">
                                @if($errors->has('image'))
                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                                <div class="fileinput {{ empty($product->image_path)?'fileinput-new':'fileinput-exists' }}" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;background-color: #e2e2e2;">
                                        @if(empty($product->image_path))
                                            <img data-src="https://placeholdit.imgix.net/~text?txtsize=12&txt={{ $product->id }}&w=55&h=55"
                                                 src="https://placeholdit.imgix.net/~text?txtsize=12&txt={{ $product->id }}&w=55&h=55"
                                                 alt="{{ $product->name }}">
                                        @else
                                            <img data-src="{{ route('imagecache', ['medium', $product->image_path]) }}" alt="{{ $product->name }}"
                                                 src="{{ route('imagecache', ['medium', $product->image_path]) }}" alt="{{ $product->name }}" class="product-image">
                                        @endif                                    </div>
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