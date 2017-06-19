@extends('layouts.base')

@section('content-header')
    <h1>
        Add Overhead Breakdown
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('overheads.index') }}"><i class="fa fa-asterisk"></i> Overhead Breakdown List</a></li>
        <li class="active">Add Overhead Breakdown</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Overhead Breakdown</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('overheads.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                        @include('partials.bs_text', ['name' => 'name', 'label' => 'Overhead Breakdown Name', 'placeholder' => '', 'useOld' => ''])
                        @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => ''])
                        @include('partials.selectpicker', ['name' => 'overhead_group_id', 'label' => 'Overhead Group', 'options' => $groups, 'useKeys' => true])
                        @include('partials.selectpicker', ['name' => 'type', 'label' => 'Overhead Type',
                            'options' => ['variable' => 'Variable Expense', 'fixed' => 'Fixed Expense', 'provision' => 'Provision Expense'], 'useKeys' => true,
                            'placeholder' => 'Select a Type',
                            'size' => 'col s12', 'useOld' => '', 'row' => true])
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