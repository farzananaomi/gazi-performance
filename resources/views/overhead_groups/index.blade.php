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
        <div class="col-md-6 col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class=table-responsive><table class="table" id="overheads-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="width: auto"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>
                                    <a href="{{ route('overhead_groups.show', [$group->id]) }}" class="btn btn-link">View</a>
                                    <a href="{{ route('overhead_groups.edit', [$group->id]) }}" class="btn btn-link">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table></div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Overhead</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('overhead_groups.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="box-body">
                    @include('partials.bs_text', ['name' => 'name', 'label' => 'Overhead Name', 'placeholder' => 'e.g. CaCO3', 'useOld' => ''])
                    @include('partials.bs_textarea', ['name' => 'description', 'label' => 'Description', 'useOld' => ''])
                    <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .table>tbody>tr>td {
            vertical-align: middle;
        }
        #ingredient-table_filter {
            display: none;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var productsTable = $('#overheads-table').DataTable({
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