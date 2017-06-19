@extends('layouts.base')

@section('content-header')
    <h1>
        Recipe List
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Recipe List</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class=table-responsive><table class="table" id="recipes-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th style="width: auto"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->name }}</td>
                                <td>
                                    <a href="{{ route('recipes.show', [$recipe->id]) }}" class="btn btn-link">View</a>
                                    <a href="{{ route('recipes.edit', [$recipe->id]) }}" class="btn btn-link">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table>tbody>tr>td {
            vertical-align: middle;
        }
        #recipe-table_filter {
            display: none;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var productsTable = $('#recipes-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                // Disable sorting on the first column
                "aoColumnDefs" : [ {
                    'bSortable' : false,
                    'aTargets' : [ -1 ]
                } ]
            });
        })
    </script>
@endsection