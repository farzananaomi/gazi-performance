@extends('layouts.base')

@section('content-header')
    <h1>
        Add Overhead
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('overhead_groups.index') }}"><i class="fa fa-asterisk"></i> Overhead List</a></li>
        <li class="active">Add Overhead</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Overhead</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('overhead_groups.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @include('partials.bs_text', ['name' => 'name', 'label' => 'Overhead Name', 'placeholder' => 'e.g. Admin Overhead', 'useOld' => ''])
                        @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => ''])
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block" style="display: inline-block; width: 50%;">Save</button>

                        <a href="{{ route('overheads.index') }}" class="btn btn-default pull-right">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection