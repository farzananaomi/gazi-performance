@extends('layouts.base')


@section('content-header')
    <h1>
        Overhead Cost Chart for <strong>{{ $header->month.', '.$header->year }}</strong>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Overhead Cost Chart</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        @foreach($header->groups as $overhead)
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
                                            @if(!empty($title->cost))
                                            <tr>
                                                <td>{{ $title->name }}</td>
                                                <td>Tk. {{ $title->cost }}</td>
                                            </tr>
                                            @endif
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
    <style>
        .cost-input {
            width: 100px !important;
        }
    </style>
@endsection

@section('scripts')
@endsection