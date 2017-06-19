@extends('layouts.base')


@section('content-header')
    <h1>
        Overhead List
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Overhead List</li>
    </ol>
@endsection

@section('content')
    <div class="row">
    @foreach($overheads as $overhead)
        <div class="col-md-6 col-xs-12">
                <div class="box">
                    <div class="box-header clearfix">
                        <div class="box-title">
                            <strong>{{ $overhead->name }}</strong>
                        </div>
                        <a href="{{ route('overhead_groups.edit', $overhead->id) }}" class="btn btn-link pull-right"> Edit</a>
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
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($type as $title)
                                            <tr>
                                                <td>{{ $title->name }}</td>
                                                <td><a href="{{ route('overheads.edit', $title->id) }}"> Edit</a></td>
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
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection