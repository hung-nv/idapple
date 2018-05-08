@extends('backend.layouts.app')

@section('title')
    Manage Ports
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
        @include('backend.blocks.theme-options')
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('port.index') }}">Ports</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Managed Ports
                <small>All</small>
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
                                    </div>
                                    <div class="col-md-6 pull-right text-right">
                                        <a class="btn sbold red" href="{{ route('port.deleteAll') }}" onclick="return confirm('Do you want to delete all?');"> Delete All</a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="data-port">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Port</th>
                                    <th> Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($data))
                                    @foreach($data as $i)

                                        <tr class="odd gradeX">
                                            <td> {{ $i->id }}</td>
                                            <td>{{ $i->port }}</td>
                                            <td>
                                                <form action="{{ route('port.destroy', $i->id) }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn red btn-sm btn-delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>

                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('#data-port').on('click', '.btn-delete', function () {
            var confirmDel = confirm('Do you want to delete this port?');
            if (confirmDel) {
                this.parent().submit();
            } else {
                return false;
            }
        });

    </script>
@endsection