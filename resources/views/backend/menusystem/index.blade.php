@extends('backend.layouts.app')

@section('header')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('title')
    Manage Menu System
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
        @include('backend.blocks.theme-options')
        <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('menuSystem.index') }}">Menu System</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Managed Menu System
                <small>All Menu System</small>
            </h3>
            <!-- END PAGE TITLE-->

            @include('backend.blocks.message')

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Data</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a class="btn sbold green" href="{{ route('menuSystem.create') }}"> Add New
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="data-menuSystem">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Label</th>
                                    <th> Icon</th>
                                    <th> Route</th>
                                    <th> Status</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($data))
                                    @foreach($data as $i)

                                        <tr class="odd gradeX">
                                            <td> {{ $i->id }}</td>
                                            <td>{{ $i->label }}</td>
                                            <td>{{ $i->icon }}</td>
                                            <td>{{ $i->route }}</td>
                                            <td>
                                                @if($i->status === 1)
                                                    <span class="label label-sm label-success"> Approved </span>
                                                @else
                                                    <span class="label label-sm label-warning"> No </span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('menuSystem.destroy', $i->id) }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <a href="{{ route('menuSystem.edit', ['menuSystem' => $i->id]) }}"
                                                       class="btn red btn-sm">Update</a>
                                                    <button type="submit" class="btn red btn-sm btn-delete">Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        @if(isset($i->child) && $i->child)
                                            @foreach($i->child as $j)
                                                <tr class="odd gradeX">
                                                    <td> {{ $j->id }}</td>
                                                    <td>|----<i>{{ $j->label }}</i></td>
                                                    <td>{{ $j->icon }}</td>
                                                    <td>{{ $j->route }}</td>
                                                    <td>
                                                        @if($j->status === 1)
                                                            <span class="label label-sm label-success"> Approved </span>
                                                        @else
                                                            <span class="label label-sm label-warning"> No </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('menuSystem.destroy', $j->id) }}"
                                                              method="POST">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <a href="{{ route('menuSystem.edit', ['menuSystem' => $j->id]) }}"
                                                               class="btn red btn-sm">Update</a>
                                                            <button type="submit" class="btn red btn-sm btn-delete">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('/admin/assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/datatables.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(function () {
            $("#data-menuSystem").dataTable({
                ordering: false,
                order: [[0, 'desc']],
                bLengthChange: true,
                bFilter: true
            });
        });

        $('#data-menuSystem').on('click', '.btn-delete', function () {
            var confirmDel = confirm('Do you want to delete this Menu System?');
            if (confirmDel) {
                this.parent().submit();
            } else {
                return false;
            }
        });

    </script>
@endsection