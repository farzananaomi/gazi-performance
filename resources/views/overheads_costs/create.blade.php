@extends('layouts.base')


@section('content-header')
    <h1>
        Create Overhead Cost Chart for <strong>{{ request('month').', '.request('year') }}</strong>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Create Overhead Cost Chart</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('overheads.costs.store', ['month' => request('month'), 'year' => request('year')]) }}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="month" value="{{ request('month') }}">
        <input type="hidden" name="year" value="{{ request('year') }}">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Save</button>
                                <button type="submit"  class="btn btn-info"><i class="fa fa-save"></i> Draft</button>
                                <a href="{{ route('overheads.costs.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    @foreach($overheads as $overhead)
        <div class="col-md-6 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title"><strong>{{ $overhead->name }}</strong></div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            @foreach (($types = $overhead->titles->groupBy('type')) as $key => $type)
                                <div class="col-md-{{ floor(12/count($types)) }}">
                                    <div class=table-responsive><table class="table">
                                        <thead>
                                        <tr>
                                            <th colspan="3"><h4 class="text-center">{{ ucfirst($key) }}</h4></th>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Cost (Tk.)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($type as $title)
                                            <tr>
                                                <td>{{ $title->name }}</td>
                                                <td><input class="cost-input" type="number" min="0" step="0.01" name="cost[{{ $title->id }}]"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
    </form>
@endsection

@section('styles')
    <style>
        .cost-input {
            width: 100px !important;
        }
    </style>
@endsection

@section('scripts')
@endsection