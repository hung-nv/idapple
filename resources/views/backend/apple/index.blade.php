@extends('backend.layouts.app')

@section('title')
    Manage Apple ID
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
                        <a href="{{ route('apple.index') }}">Apple ID</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Managed Apple ID
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
                                        @if(Auth::user()->role == 1)
                                            <div class="btn-group">
                                                <a class="btn sbold green" href="{{ route('apple.insert') }}"> Insert Apple ID with excel
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <form method="GET" action="{{ route('apple.index') }}">
                                            <div class="pull-right search">
                                                <input class="form-control" type="text" name="domain" value="{{ Request::query('domain') }}" placeholder="Search by domain">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="data-apple">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Apple ID</th>
                                    <th> Password</th>
                                    <th> Answer 1</th>
                                    <th> Answer 2+3</th>
                                    @if(Auth::user()->role == 1)
                                        <th> Actions</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($data))
                                    @foreach($data as $i)

                                        <tr class="odd gradeX">
                                            <td> {{ $i->id }}</td>
                                            <td>{{ $i->apple_id }}</td>
                                            <td>{{ $i->password }}</td>
                                            <td>{{ $i->answer_first }}</td>
                                            <td>{{ $i->answer_second }}</td>
                                            @if(Auth::user()->role == 1)
                                                <td>
                                                    <form action="{{ route('apple.destroy', $i->id) }}" method="POST">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn red btn-sm btn-delete">Delete</button>
                                                    </form>
                                                </td>
                                            @endif
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
        $('#data-apple').on('click', '.btn-delete', function () {
            var confirmDel = confirm('Do you want to delete this apple_id?');
            if (confirmDel) {
                this.parent().submit();
            } else {
                return false;
            }
        });

    </script>
@endsection