@extends('backend.layouts.app')

@section('title')
    Manage user
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('apple.index') }}">Apple Id</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Insert</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->

            <h3 class="page-title"> Apple ID
                <small>Insert</small>
            </h3>

            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="margin-bottom: 30px;">

                    <div class="apple-errors">
                        @include('backend.blocks.errors')
                    </div>

                    <p class="font-red-mint">
                        File excel phải đúng định dạng thứ tự và giá trị hàng đầu tiên như sau:<br />
                        + apple_id, password, answer_1, answer_2
                        <br /><br />
                        File txt mỗi id 1 hàng, mỗi dữ liệu 1 hàng phân biệt bởi dấu "|", vd:<br />
                        + id_apple@gmail.com | password | answer1 | answer2
                    </p>

                    <form action="{{ route('apple.store') }}" class="form-horizontal" role="form"
                          method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-3">Select file</label>
                            <div class="col-md-4">
                                <input type="file" id="file" name="file" accept=".xls,.xlsx,.txt"/>
                                <p class="help-block"> Please select xls/xlsx/txt file. </p>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green btn-backend">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 col-md-offset-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Thống kê</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            @if(Session::has('success_message'))
                                <div class="well">
                                    {{Session::get('success_message')}}
                                </div>
                            @endif

                            @if(Session::has('error_message'))
                                <div class="alert alert-warning">
                                    {{Session::get('error_message')}}
                                </div>
                            @endif

                            <div class="well">
                                Tổng số ID: {{ $total }} <br />
                                Tổng số ID đã bán: {{ $sell }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection